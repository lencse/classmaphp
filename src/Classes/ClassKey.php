<?php

namespace Lencse\ClassMap\Classes;

class ClassKey
{
    /**
     * @var string
     */
    private $namespaceId;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $namespaceId, string $name)
    {
        $this->namespaceId = $namespaceId;
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->namespaceId . '-' . $this->name;
    }
}
