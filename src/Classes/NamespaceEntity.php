<?php

namespace Lencse\ClassMap\Classes;

final class NamespaceEntity implements PHPNamespace
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var NamespaceEntityCollection
     */
    private $dependencies;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->dependencies = new NamespaceEntityCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->getName();
    }

    public function addDependency(PHPNamespace $dependency): void
    {
        $this->dependencies->add($dependency);
    }

    public function getDependencies(): PHPNamespaceList
    {
        return $this->dependencies;
    }
}
