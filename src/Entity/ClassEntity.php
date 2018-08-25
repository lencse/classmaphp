<?php

namespace Lencse\ClassMap\Entity;

final class ClassEntity
{
    /**
     * @var NamespaceEntity
     */
    private $namespace;

    /**
     * @var string
     */
    private $name;

    public function __construct(NamespaceEntity $namespace, string $name)
    {
        $this->namespace = $namespace;
        $this->name = $name;
    }

    public function getNamespace(): NamespaceEntity
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
