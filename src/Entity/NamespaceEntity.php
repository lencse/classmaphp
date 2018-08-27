<?php

namespace Lencse\ClassMap\Entity;

final class NamespaceEntity implements HasKey
{
    /**
     * @var PackageEntity
     */
    private $package;

    /**
     * @var string
     */
    private $id;

    /**
     * @var ClassEntityCollection
     */
    private $subClasses;

    public function __construct(PackageEntity $package, string $id)
    {
        $this->package = $package;
        $this->id = $id;
        $this->subClasses = new ClassEntityCollection();
    }

    public function getPackage(): PackageEntity
    {
        return $this->package;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function same(self $other): bool
    {
        return $other->getId() === $this->getId()
            && $other->getPackage()->same($this->getPackage());
    }

    public function getKey(): string
    {
        return "{$this->getPackage()->getKey()}>{$this->getId()}";
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
