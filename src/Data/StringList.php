<?php

namespace Lencse\ClassMap\Data;

use Iterator;

final class StringList implements Iterator
{
    /**
     * @var string[]
     */
    private $strings = [];

    public function add(string $class): self
    {
        $result = clone $this;
        $result->strings[] = $class;

        return $result;
    }

    public function current(): string
    {
        return current($this->strings);
    }

    /**
     * @return false|string
     */
    public function next()
    {
        return next($this->strings);
    }

    public function key()
    {
        return key($this->strings);
    }

    public function valid(): bool
    {
        return null !== key($this->strings) && false !== key($this->strings);
    }

    public function rewind(): void
    {
        reset($this->strings);
    }
}
