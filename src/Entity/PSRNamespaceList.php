<?php

namespace Lencse\ClassMap\Entity;

use Iterator;

class PSRNamespaceList implements Iterator
{
    /**
     * @var PSRNamespace[]
     */
    private $namespaces = [];

    public function add(PSRNamespace $namespace): self
    {
        $result = clone $this;
        $result->namespaces[] = $namespace;

        return $result;
    }

    public function current(): PSRNamespace
    {
        return current($this->namespaces);
    }

    /**
     * @return false|PSRNamespace
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
}
