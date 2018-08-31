<?php

namespace Lencse\ClassMap\Classes;

use Countable;
use Iterator;

interface PHPNamespaceList extends Iterator, Countable
{
    public function current(): PHPNamespace;

    /**
     * @return false|PHPNamespace
     */
    public function next();

    public function key(): string;

    public function valid(): bool;

    public function rewind(): void;

    public function count(): int;
}
