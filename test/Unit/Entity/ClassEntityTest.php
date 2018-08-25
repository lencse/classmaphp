<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\ClassEntity;

class ClassEntityTest extends ClassEntityTestBase
{
    public function testClassAttributes()
    {
        $class = new ClassEntity($this->namespaces[0], $this->classNames[0]);
        $this->assertEquals($this->namespaces[0], $class->getNamespace());
        $this->assertEquals($this->classNames[0], $class->getName());
    }

    public function testRelationship()
    {
        $class = new ClassEntity($this->namespaces[0], $this->classNames[0]);
        $this->assertArraySubset([$class], iterator_to_array($class->getNamespace()->getSubClasses()));
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
