<?php

namespace Lencse\ClassMap\Classes;

use Countable;
use Iterator;

final class DependencyCollection implements Iterator, Countable
{
    /**
     * @var Dependency[]
     */
    private $dependencies = [];

    public function addNamespaceDependency(NamespaceEntity $namespace): void
    {
        if (isset($this->dependencies[$namespace->getKey()])) {
            $this->dependencies[$namespace->getKey()] = $this->dependencies[$namespace->getKey()]->incremented();

            return;
        }

        $this->dependencies[$namespace->getKey()] = new Dependency($namespace);
    }

    public function current(): Dependency
    {
        return current($this->dependencies);
    }

    /**
     * @return false|Dependency
     */
    public function next()
    {
        return next($this->dependencies);
    }

    public function key(): string
    {
        return (string) key($this->dependencies);
    }

    public function valid(): bool
    {
        return null !== key($this->dependencies) && false !== key($this->dependencies);
    }

    public function rewind(): void
    {
        reset($this->dependencies);
    }

    public function count(): int
    {
        return count($this->dependencies);
    }
}
