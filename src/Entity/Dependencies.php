<?php

namespace Lencse\ClassMap\Entity;

final class Dependencies
{
    /**
     * @var Dependency[]
     */
    private $data = [];

    public function applyDependency(Dependency $dependency): self
    {
        $result = clone $this;
        $result->data[] = $dependency;

        return $result;
    }

    public function getDependenciesForNamespace(PSRNamespace $namespace): PSRNamespaceList
    {
        $result = new PSRNamespaceList();
        foreach ($this->data as $dependency) {
            if ($namespace === $dependency->getDependant()) {
                $result = $result->add($dependency->getDependency());
            }
        }

        return $result;
    }
}
