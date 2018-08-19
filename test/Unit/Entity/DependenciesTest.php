<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\Dependencies;
use Lencse\ClassMap\Entity\SubNamespace;
use PHPUnit\Framework\TestCase;

class DependenciesTest extends TestCase
{
    public function testDependencies()
    {
        $namespace = (new SubNamespace('Something'));
        $dependency1 = new SubNamespace('Dependency1');
        $dependency2 = new SubNamespace('Dependency2');
        $dependencies = (new Dependencies($namespace))
            ->withDependency($dependency1)
            ->withDependency($dependency2);

        $this->assertEquals($namespace, $dependencies->getDependant());
        $this->assertEquals([$dependency1, $dependency2], iterator_to_array($dependencies->getDependencies()));
    }
}
