<?php

namespace Lencse\ClassMap\Entity;

class Dependencies
{
    /**
     * @var PSRNamespace
     */
    private $dependant;

    /**
     * @var PSRNamespaceList
     */
    private $dependencies;

    public function __construct(PSRNamespace $dependant)
    {
        $this->dependant = $dependant;
        $this->dependencies = new PSRNamespaceList();
    }

    public function withDependency(PSRNamespace $dependency): self
    {
        $result = clone $this;
        $result->dependencies = $this->dependencies->add($dependency);

        return $result;
    }

    public function getDependant(): PSRNamespace
    {
        return $this->dependant;
    }

    public function getDependencies(): PSRNamespaceList
    {
        return $this->dependencies;
    }
}
