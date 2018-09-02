<?php

namespace Test\Unit\Classes;

use Lencse\ClassMap\Classes\Dependency;
use Lencse\ClassMap\Classes\NamespaceEntity;
use PHPUnit\Framework\TestCase;

class NamespaceEntityDependenciesTest extends TestCase
{
    /**
     * @var NamespaceEntity[]
     */
    private $namespaces = [];

    public function setUp()
    {
        $this->namespaces = [
            new NamespaceEntity('Test\\Namespace1'),
            new NamespaceEntity('Test\\Namespace2'),
            new NamespaceEntity('Test\\Namespace3'),
            new NamespaceEntity('Test\\Namespace4'),
            new NamespaceEntity('Test\\Namespace5'),
        ];
    }

    public function testEmptyDependency()
    {
        $this->assertEquals(0, $this->namespaces[0]->getDependencies()->count());
    }

    public function testOneNamespaceDependency()
    {
        $this->addDependency(0, 1);
        $this->assertNamespaceDependencies([1 => 1], 0);
    }

    public function testNamespaceDependencies()
    {
        $this->addDependency(0, 1);
        $this->addDependency(0, 2);
        $this->addDependency(0, 1);
        $this->addDependency(1, 2);
        $this->addDependency(3, 2);
        $this->addDependency(3, 2);
        $this->addDependency(3, 2);
        $this->addDependency(3, 2);
        $this->addDependency(3, 2);
        $this->addDependency(3, 2);
        $this->addDependency(3, 0);
        $this->addDependency(4, 2);

        $this->assertNamespaceDependencies([1 => 2, 2 => 1], 0);
        $this->assertNamespaceDependencies([2 => 1], 1);
        $this->assertNamespaceDependencies([0 => 1, 2 => 6], 3);
        $this->assertNamespaceDependencies([2 => 1], 4);
    }

    private function addDependency(int $dependentIdx, int $dependencyIdx): void
    {
        $this->namespaces[$dependentIdx]->addDependency($this->namespaces[$dependencyIdx]);
    }

    /**
     * @param int[] $expectedIdx
     * @param int $dependentIdx
     */
    private function assertNamespaceDependencies(array $expectedIdx, int $dependentIdx): void
    {
        $expectedArr = [];
        foreach ($expectedIdx as $idx => $cardinality) {
            $namespace = $this->namespaces[$idx];
            $expectedArr[$namespace->getKey()] = new Dependency($namespace, $cardinality);
        }
        $this->assertEquals(
            $expectedArr,
            iterator_to_array($this->namespaces[$dependentIdx]->getDependencies())
        );
    }
}
