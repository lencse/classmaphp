<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\NamespaceEntity;
use Lencse\ClassMap\Entity\PackageEntity;
use PHPUnit\Framework\TestCase;

class NamespaceEntityTest extends TestCase
{
    public function testNamespaceAttributes()
    {
        $namespace = new NamespaceEntity('Test\\Entity');
        $this->assertEquals('Test\\Entity', $namespace->getId());
    }

    public function testSameNamespace()
    {
        $namespace1 = new NamespaceEntity('Test\\Entity');
        $namespace2 = new NamespaceEntity('Test\\Entity');
        $this->assertTrue($namespace1->same($namespace2));
    }

    public function testNotSameWhenIdIsDifferent()
    {
        $namespace1 = new NamespaceEntity('Test\\Entity1');
        $namespace2 = new NamespaceEntity('Test\\Entity2');
        $this->assertFalse($namespace1->same($namespace2));
    }
}
