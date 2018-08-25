<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\ClassEntity;
use Lencse\ClassMap\Entity\NamespaceEntity;
use Lencse\ClassMap\Entity\PackageEntity;
use PHPUnit\Framework\TestCase;

class ClassEntityTest extends ClassEntityTestBase
{
    public function testClassAttributes()
    {
        $class = new ClassEntity($this->namespaces[0], $this->classNames[0]);
        $this->assertEquals($this->namespaces[0], $class->getNamespace());
        $this->assertEquals($this->classNames[0], $class->getName());
    }

    public function testSameClass()
    {
        $class1 = new ClassEntity($this->namespaces[0], $this->classNames[0]);
        $class2 = new ClassEntity($this->namespaces[0], $this->classNames[0]);
        $this->assertTrue($class1->same($class2));
    }

    public function testNotSameWhenNameIsDifferent()
    {
        $class1 = new ClassEntity($this->namespaces[0], $this->classNames[1]);
        $class2 = new ClassEntity($this->namespaces[0], $this->classNames[2]);
        $this->assertFalse($class1->same($class2));
    }

    public function testNotSameWhenPackageIsDifferent()
    {
        $class1 = new ClassEntity($this->namespaces[0], $this->classNames[0]);
        $class2 = new ClassEntity($this->namespaces[1], $this->classNames[0]);
        $this->assertFalse($class1->same($class2));
    }
}
