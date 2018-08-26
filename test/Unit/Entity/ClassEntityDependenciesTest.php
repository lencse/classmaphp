<?php

namespace Test\Unit\Entity;

class ClassEntityDependenciesTest extends ClassEntityTestBase
{
    public function testEmptyDependency()
    {
        $class = $this->createClass(0, 0);
        $this->assertEquals(0, $class->getDependencies()->count());
    }

    public function testDependency()
    {
        $class = $this->createClass(0, 0);
        $class->addDependency($this->createClass(0, 1));
        $this->assertEquals([$this->createClass(0, 1)], iterator_to_array($class->getDependencies()));
    }

    public function testNamespaceDependencies()
    {
        $class1 = $this->createClass(0, 0);
        $class2 = $this->createClass(1, 1);
        $class1->addDependency($class2);
        $this->assertEquals(
            [$this->namespaces[1]],
            iterator_to_array($this->namespaces[0]->getNamespaceDependencies())
        );
    }
}
