<?php

namespace Lencse\ClassMap\Classes;

final class Dependency
{
    /**
     * @var NamespaceEntity
     */
    private $dependencyNamespace;

    /**
     * @var int
     */
    private $cardinality ;

    public function __construct(NamespaceEntity $dependencyNamespace, int $cardinality = 1)
    {
        $this->dependencyNamespace = $dependencyNamespace;
        $this->cardinality = $cardinality;
    }

    public function getNamespace(): NamespaceEntity
    {
        return $this->dependencyNamespace;
    }

    public function getCardinality(): int
    {
        return $this->cardinality;
    }

    public function incremented(): self
    {
        $result = clone $this;
        ++$result->cardinality;

        return $result;
    }
}
