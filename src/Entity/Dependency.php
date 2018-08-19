<?php

namespace Lencse\ClassMap\Entity;

final class Dependency
{
    /**
     * @var PSRNamespace
     */
    private $dependant;

    /**
     * @var PSRNamespace
     */
    private $dependency;

    public function __construct(PSRNamespace $dependant, PSRNamespace $dependency)
    {
        $this->dependant = $dependant;
        $this->dependency = $dependency;
    }

    public function getDependant(): PSRNamespace
    {
        return $this->dependant;
    }

    public function getDependency(): PSRNamespace
    {
        return $this->dependency;
    }
}
