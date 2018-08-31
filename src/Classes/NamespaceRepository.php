<?php

namespace Lencse\ClassMap\Classes;

final class NamespaceRepository
{
    /**
     * @var PHPNamespace[]
     */
    private $namespaces = [];

    public function get(string $id): PHPNamespace
    {
        if (isset($this->namespaces[$id])) {
            return $this->namespaces[$id];
        }

        return $this->namespaces[$id] = new NamespaceEntity($id);
    }

    public function getNamespaces(): PHPNamespaceList
    {
        $result = new NamespaceEntityCollection();
        foreach ($this->namespaces as $namespace) {
            $result->add($namespace);
        }

        return $result;
    }
}
