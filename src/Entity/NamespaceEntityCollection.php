<?php

namespace Lencse\ClassMap\Entity;

use Iterator;

final class NamespaceEntityCollection implements Iterator
{
    /**
     * @var NamespaceEntity[]
     */
    private $classes = [];

    public function add(NamespaceEntity $namespace): void
    {
        if (isset($this->classes[$namespace->getKey()])) {
            return;
        }

        $this->classes[$namespace->getKey()] = $namespace;
    }

    public function current(): NamespaceEntity
    {
        return current($this->classes);
    }

    /**
     * @return false|NamespaceEntity
     */
    public function next()
    {
        return next($this->classes);
    }

    public function key()
    {
        return key($this->classes);
    }

    public function valid(): bool
    {
        return null !== key($this->classes) && false !== key($this->classes);
    }

    public function rewind(): void
    {
        reset($this->classes);
    }
}
