<?php

namespace Lencse\ClassMap\Classes;

use Countable;
use Iterator;

final class ClassEntityCollection implements Iterator, Countable
{
    /**
     * @var ClassEntity[]
     */
    private $classes = [];

    public function add(ClassEntity $class): void
    {
        if (isset($this->classes[$class->getKey()])) {
            return;
        }

        $this->classes[$class->getKey()] = $class;
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
