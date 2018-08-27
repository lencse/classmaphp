<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\ClassEntity;
use Lencse\ClassMap\Entity\NamespaceEntity;
use Lencse\ClassMap\Entity\PackageEntity;
use PHPUnit\Framework\TestCase;

abstract class ClassEntityTestBase extends TestCase
{
    /**
     * @var string[]
     */
    protected $classNames;

    /**
     * @var NamespaceEntity[]
     */
    protected $namespaces = [];

    /**
     * @var ClassEntity[]
     */
    protected $classes = [];

    public function setUp()
    {
        $this->classNames = [
            'ClassName1',
            'ClassName2',
            'ClassName3',
            'ClassName4',
            'ClassName5',
        ];
        $this->namespaces = [
            new NamespaceEntity('Test\\Namespace1'),
            new NamespaceEntity('Test\\Namespace2'),
            new NamespaceEntity('Test\\Namespace3'),
            new NamespaceEntity('Test\\Namespace4'),
            new NamespaceEntity('Test\\Namespace5'),
        ];
    }

    protected function createClass(int $namespaceIdx, int $nameIdx): ClassEntity
    {
        return new ClassEntity($this->namespaces[$namespaceIdx], $this->classNames[$nameIdx]);
    }
}
