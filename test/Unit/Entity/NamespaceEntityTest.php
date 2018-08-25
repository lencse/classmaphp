<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\NamespaceEntity;
use Lencse\ClassMap\Entity\PackageEntity;
use PHPUnit\Framework\TestCase;

class NamespaceEntityTest extends TestCase
{
    public function testNamespaceAttributes()
    {
        $namespace = new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity');
        $this->assertEquals('lencse/classmaphp', $namespace->getPackage()->getId());
        $this->assertEquals('Test\\Entity', $namespace->getId());
    }

    public function testSameNamespace()
    {
        $namespace1 = new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity');
        $namespace2 = new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity');
        $this->assertTrue($namespace1->same($namespace2));
    }

    public function testNotSameWhenIdIsDifferent()
    {
        $namespace1 = new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity1');
        $namespace2 = new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity2');
        $this->assertFalse($namespace1->same($namespace2));
    }

    public function testNotSameWhenPackageIsDifferent()
    {
        $namespace1 = new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity');
        $namespace2 = new NamespaceEntity(new PackageEntity('lencse/other'), 'Test\\Entity');
        $this->assertFalse($namespace1->same($namespace2));
    }
}
