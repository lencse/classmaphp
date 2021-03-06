<?php

namespace Lencse\ClassMap\Classes;

final class NamespaceRepository
{
    /**
     * @var NamespaceEntity[]
     */
    private $namespaces = [];

    public function get(string $id): NamespaceEntity
    {
        if (isset($this->namespaces[$id])) {
            return $this->namespaces[$id];
        }

        return $this->namespaces[$id] = new NamespaceEntity($id);
    }

    public function getNamespaces(): NamespaceEntityCollection
    {
        $result = new NamespaceEntityCollection();
        foreach ($this->namespaces as $namespace) {
            $result->add($namespace);
        }

        return $result;
    }
}
