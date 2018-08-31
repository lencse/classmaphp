<?php

namespace Lencse\ClassMap\Classes;

final class NamespaceEntity
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var NamespaceEntityCollection
     */
    private $dependencies;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->dependencies = new NamespaceEntityCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function same(self $other): bool
    {
        return $other->getId() === $this->getId();
    }

    public function getKey(): string
    {
        return $this->getId();
    }

    public function addDependency(self $dependency): void
    {
        $this->dependencies->add($dependency);
    }

    public function getDependencies(): NamespaceEntityCollection
    {
        return $this->dependencies;
    }
}
