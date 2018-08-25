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
        $class = $this->createClass(0, 0)->addDependency($this->createClass(0, 1));
        $this->assertEquals([$this->createClass(0, 1)], iterator_to_array($class->getDependencies()));
    }
}
