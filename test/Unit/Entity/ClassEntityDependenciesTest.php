<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Classes\ClassEntity;

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
        $this->assertEquals([$this->createClass(0, 1)], array_values(iterator_to_array($class->getDependencies())));
    }

    public function testOneNamespaceDependency()
    {
        $class1 = $this->createClass(0, 0);
        $class2 = $this->createClass(1, 1);
        $class1->addDependency($class2);
        $this->assertEquals(
            [$this->namespaces[1]->getKey() => $this->namespaces[1]],
            iterator_to_array($this->namespaces[0]->getNamespaceDependencies())
        );
    }

    public function testNamespaceDependencies()
    {
        /** @var ClassEntity[][] $classes */
        $classes = [
            [
                $this->createClass(0, 0),
                $this->createClass(0, 1),
                $this->createClass(0, 2)
            ],
            [
                $this->createClass(1, 0),
                $this->createClass(1, 1),
                $this->createClass(1, 2)
            ],
            [
                $this->createClass(2, 0),
                $this->createClass(2, 1),
                $this->createClass(2, 2)
            ],
            [
                $this->createClass(3, 0),
                $this->createClass(3, 1),
                $this->createClass(3, 2)
            ],
            [
                $this->createClass(4, 0),
                $this->createClass(4, 1),
                $this->createClass(4, 2)
            ]
        ];
        $classes[0][0]->addDependency($classes[1][0]);
        $classes[0][0]->addDependency($classes[2][0]);
        $classes[0][1]->addDependency($classes[1][0]);
        $classes[1][0]->addDependency($classes[2][0]);
        $classes[3][0]->addDependency($classes[2][0]);
        $classes[3][0]->addDependency($classes[2][0]);
        $classes[3][1]->addDependency($classes[2][0]);
        $classes[3][1]->addDependency($classes[2][1]);
        $classes[3][2]->addDependency($classes[2][2]);
        $classes[3][2]->addDependency($classes[2][0]);
        $classes[3][0]->addDependency($classes[0][1]);
        $classes[4][1]->addDependency($classes[2][2]);

        $this->assertNamespaceDependencies([1, 2], 0);
        $this->assertNamespaceDependencies([2], 1);
        $this->assertNamespaceDependencies([0, 2], 3);
        $this->assertNamespaceDependencies([2], 4);
    }

    /**
     * @param int[] $expectedIdx
     * @param int $dependentIdx
     */
    private function assertNamespaceDependencies(array $expectedIdx, int $dependentIdx): void
    {
        $expectedArr = [];
        foreach ($expectedIdx as $idx) {
            $namespace = $this->namespaces[$idx];
            $expectedArr[$namespace->getKey()] = $namespace;
        }
        $this->assertEquals(
            $expectedArr,
            iterator_to_array($this->namespaces[$dependentIdx]->getNamespaceDependencies())
        );
    }
}
