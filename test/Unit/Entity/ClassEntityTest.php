<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\ClassEntity;
use Lencse\ClassMap\Entity\NamespaceEntity;
use Lencse\ClassMap\Entity\PackageEntity;
use PHPUnit\Framework\TestCase;

class ClassEntityTest extends TestCase
{
    public function testClassAttributes()
    {
        $class = new ClassEntity(
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity'),
            'ClassName'
        );
        $this->assertEquals('lencse/classmaphp', $class->getNamespace()->getPackage()->getId());
        $this->assertEquals('Test\\Entity', $class->getNamespace()->getId());
        $this->assertEquals('ClassName', $class->getName());
    }

    public function testSameClass()
    {
        $class1 = new ClassEntity(
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity'),
            'ClassName'
        );
        $class2 = new ClassEntity(
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity'),
            'ClassName'
        );
        $this->assertTrue($class1->same($class2));
    }

    public function testNotSameWhenIdIsDifferent()
    {
        $class1 = new ClassEntity(
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity'),
            'ClassName1'
        );
        $class2 = new ClassEntity(
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity'),
            'ClassName2'
        );
        $this->assertFalse($class1->same($class2));
    }

    public function testNotSameWhenPackageIsDifferent()
    {
        $class1 = new ClassEntity(
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity'),
            'ClassName'
        );
        $class2 = new ClassEntity(
            new NamespaceEntity(new PackageEntity('lencse/other'), 'Test\\Entity'),
            'ClassName'
        );
        $this->assertFalse($class1->same($class2));
    }
}
