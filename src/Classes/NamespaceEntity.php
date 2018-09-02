<?php

namespace Lencse\ClassMap\Classes;

final class NamespaceEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var DependencyCollection
     */
    private $dependencies;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->dependencies = new DependencyCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->getName();
    }

    public function addDependency(self $dependency): void
    {
        $this->dependencies->addNamespaceDependency($dependency);
    }

    public function getDependencies(): DependencyCollection
    {
        return $this->dependencies;
    }
}
