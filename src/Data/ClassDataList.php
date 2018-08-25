<?php

namespace Lencse\ClassMap\Data;

use Iterator;

final class ClassDataList implements Iterator
{
    /**
     * @var ClassData[]
     */
    private $classes = [];

    public function add(ClassData $class): self
    {
        $result = clone $this;
        $result->classes[] = $class;

        return $result;
    }

    public function current(): ClassData
    {
        return current($this->classes);
    }

    /**
     * @return false|ClassData
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
