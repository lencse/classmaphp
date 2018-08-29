<?php

namespace Lencse\ClassMap\Classes;

use Countable;
use Iterator;

final class NamespaceEntityCollection implements Iterator, Countable
{
    /**
     * @var NamespaceEntity[]
     */
    private $namespaces = [];

    public function add(NamespaceEntity $namespace): void
    {
        if (isset($this->namespaces[$namespace->getKey()])) {
            return;
        }

        $this->namespaces[$namespace->getKey()] = $namespace;
    }

    public function current(): NamespaceEntity
    {
        return current($this->namespaces);
    }

    /**
     * @return false|NamespaceEntity
     */
    public function next()
    {
        return next($this->namespaces);
    }

    public function key()
    {
        return key($this->namespaces);
    }

    public function valid(): bool
    {
        return null !== key($this->namespaces) && false !== key($this->namespaces);
    }

    public function rewind(): void
    {
        reset($this->namespaces);
    }

    public function count()
    {
        return count($this->namespaces);
    }
}
