<?php

namespace Test\Unit\Classes;

use Lencse\ClassMap\Classes\Dependency;
use Lencse\ClassMap\Classes\NamespaceEntity;
use PHPUnit\Framework\TestCase;

class DependencyTest extends TestCase
{
    public function testDependency()
    {
        $dependency = new Dependency(new NamespaceEntity('Namespace'), 2);
        $this->assertEquals('Namespace', $dependency->getNamespace()->getName());
        $this->assertEquals(2, $dependency->getCardinality());
    }
}
