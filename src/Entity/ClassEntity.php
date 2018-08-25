<?php

namespace Lencse\ClassMap\Entity;

final class ClassEntity
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
     * @var ClassEntityList
     */
    private $dependencies;

    public function __construct(NamespaceEntity $namespace, string $name)
    {
        $this->namespace = $namespace;
        $this->name = $name;
        $this->dependencies = new ClassEntityList();
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

    public function getDependencies(): ClassEntityList
    {
        return $this->dependencies;
    }

    public function addDependency(self $dependency): self
    {
        $this->dependencies = $this->dependencies->add($dependency);

        return $this;
    }
}
