<?php

namespace Lencse\ClassMap\Value;

final class ClassData
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var StringList
     */
    private $dependencies;

    public function __construct(string $name, string $namespace, StringList $dependencies)
    {
        $this->name = $name;
        $this->namespace = $namespace;
        $this->dependencies = $dependencies;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getDependencies(): StringList
    {
        return $this->dependencies;
    }
}
