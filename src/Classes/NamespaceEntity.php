<?php

namespace Lencse\ClassMap\Classes;

final class NamespaceEntity implements Entity
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var ClassEntityCollection
     */
    private $subClasses;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->subClasses = new ClassEntityCollection();
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
        return new NamespaceKey($this->getId());
    }

    public function addSubClass(ClassEntity $class): void
    {
        $this->subClasses->add($class);
    }

    public function getSubClasses(): ClassEntityCollection
    {
        return $this->subClasses;
    }

    public function getNamespaceDependencies(): NamespaceEntityCollection
    {
        $result = new NamespaceEntityCollection();
        foreach ($this->getSubClasses() as $subClass) {
            foreach ($subClass->getDependencies() as $dependency) {
                $result->add($dependency->getNamespace());
            }
        }

        return $result;
    }
}
