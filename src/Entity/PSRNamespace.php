<?php

namespace Lencse\ClassMap\Entity;

class PSRNamespace
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var PSRNamespaceList
     */
    private $dependencies;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->dependencies = new PSRNamespaceList();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function withDependency(self $dependecy): self
    {
        $result = clone $this;
        $result->dependencies = $this->dependencies->add($dependecy);

        return $result;
    }

    public function getDependencies(): PSRNamespaceList
    {
        return $this->dependencies;
    }
}
