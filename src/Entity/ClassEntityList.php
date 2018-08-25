<?php

namespace Lencse\ClassMap\Entity;

use Countable;
use Iterator;

final class ClassEntityList implements Iterator, Countable
{
    /**
     * @var ClassEntity[]
     */
    private $classes = [];

    public function add(ClassEntity $class): self
    {
        $result = clone $this;
        $result->classes[] = $class;

        return $result;
    }

    public function current(): ClassEntity
    {
        return current($this->classes);
    }

    /**
     * @return false|ClassEntity
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

    public function count(): int
    {
        return count($this->classes);
    }
}
