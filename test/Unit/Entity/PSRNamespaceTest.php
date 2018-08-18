<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\PSRNamespace;
use PHPUnit\Framework\TestCase;

class PSRNamespaceTest extends TestCase
{
    public function testId()
    {
        $namespace = new PSRNamespace('Something');
        $this->assertEquals('Something', $namespace->getId());
    }

    public function testDependencies()
    {
        $dependency1 = new PSRNamespace('Dependency1');
        $dependency2 = new PSRNamespace('Dependency2');
        $namespace = (new PSRNamespace('Something'))
            ->withDependency($dependency1)
            ->withDependency($dependency2);
        $this->assertEquals([$dependency1, $dependency2], iterator_to_array($namespace->getDependencies()));
    }
}
