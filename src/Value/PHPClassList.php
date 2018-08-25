<?php

namespace Lencse\ClassMap\Value;

use Iterator;

final class PHPClassList implements Iterator
{
    /**
     * @var PHPClass[]
     */
    private $classes = [];

    public function add(PHPClass $class): self
    {
        $result = clone $this;
        $result->classes[] = $class;

        return $result;
    }

    public function current(): PHPClass
    {
        return current($this->classes);
    }

    /**
     * @return false|PHPClass
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
