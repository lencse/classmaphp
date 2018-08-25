<?php

namespace Lencse\ClassMap\Value;

final class PHPClass
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $namespace;

    public function __construct(string $name, string $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }
}
