<?php

namespace Lencse\ClassMap\Classes;

final class ClassEntity implements Entity
{
    /**
     * @var NamespaceEntity
     */
    private $namespace;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ClassEntityCollection
     */
    private $dependencies;

    public function __construct(NamespaceEntity $namespace, string $name)
    {
        $this->namespace = $namespace;
        $this->name = $name;
        $this->dependencies = new ClassEntityCollection();
        $this->namespace->addSubClass($this);
    }

    public function getNamespace(): NamespaceEntity
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function same(self $other): bool
    {
        return $other->getName() === $this->getName()
            && $other->getNamespace()->same($this->getNamespace());
    }

    public function getKey(): string
    {
        return "{$this->getNamespace()->getKey()}>{$this->getName()}";
    }

    public function getDependencies(): ClassEntityCollection
    {
        return $this->dependencies;
    }

    public function addDependency(self $dependency): void
    {
        $this->dependencies->add($dependency);
    }
}
