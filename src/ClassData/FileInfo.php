<?php

namespace Lencse\ClassMap\ClassData;

final class FileInfo
{
    /**
     * @var string
     */
    private $namespace;

    /**
     * @var StringList
     */
    private $dependencies;

    public function __construct(string $namespace, StringList $dependencies)
    {
        $this->namespace = $namespace;
        $this->dependencies = $dependencies;
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
