<?php

namespace Lencse\ClassMap\Classes;

use Countable;
use Iterator;

final class NamespaceEntityCollection implements Iterator
{
    /**
     * @var NamespaceEntity[]
     */
    private $namespaces = [];

    public function add(NamespaceEntity $namespace): void
    {
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

    public function key(): string
    {
        return (string) key($this->namespaces);
    }

    public function valid(): bool
    {
        return null !== key($this->namespaces) && false !== key($this->namespaces);
    }

    public function rewind(): void
    {
        reset($this->namespaces);
    }
}
