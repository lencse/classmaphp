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

    public function withDependency(self $dependency): self
    {
        $result = clone $this;
        $result->dependencies = $this->dependencies->add($dependency);

        return $result;
    }
}
