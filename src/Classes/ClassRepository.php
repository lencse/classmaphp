<?php

namespace Lencse\ClassMap\Classes;

final class ClassRepository
{
    /**
     * @var ClassEntity[]
     */
    private $classes = [];

    public function get(NamespaceEntity $namespace, string $name): ClassEntity
    {
        $key = (string) new ClassKey($namespace->getId(), $name);
        if (isset($this->classes[$key])) {
            return $this->classes[$key];
        }

        return $this->classes[$key] = new ClassEntity($namespace, $name);
    }
}
