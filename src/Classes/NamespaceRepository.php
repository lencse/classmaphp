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
        $key = (string) new NamespaceKey($id);
        if (isset($this->namespaces[$key])) {
            return $this->namespaces[$key];
        }

        return $this->namespaces[$key] = new NamespaceEntity($id);
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
