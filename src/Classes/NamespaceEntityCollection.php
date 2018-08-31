<?php

namespace Lencse\ClassMap\Classes;

final class NamespaceEntityCollection implements PHPNamespaceList
{
    /**
     * @var PHPNamespace[]
     */
    private $namespaces = [];

    public function add(PHPNamespace $namespace): void
    {
        if (isset($this->namespaces[$namespace->getKey()])) {
            return;
        }

        $this->namespaces[$namespace->getKey()] = $namespace;
    }

    public function current(): PHPNamespace
    {
        return current($this->namespaces);
    }

    /**
     * @return false|PHPNamespace
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

    public function count(): int
    {
        return count($this->namespaces);
    }
}
