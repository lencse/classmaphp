<?php

namespace Test\Unit\Entity;

class ClassEntityDependenciesTest extends ClassEntityTestBase
{
    public function testEmptyDependency()
    {
        $class = $this->classes[0];
        $this->assertEquals(0, $class->getDependencies()->count());
    }

    public function testDependency()
    {
        $class = $this->classes[0]->withDependency($this->classes[1]);
        $this->assertEquals([$this->classes[1]], iterator_to_array($class->getDependencies()));
    }
}
