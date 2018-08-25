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
            'ClassName',
            'ClassName1',
            'ClassName2',
        ];
        $this->namespaces = [
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity'),
            new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\OtherNamespace'),
        ];
    }

    protected function createClass(int $namespaceIdx, int $nameIdx): ClassEntity
    {
        return new ClassEntity($this->namespaces[$namespaceIdx], $this->classNames[$nameIdx]);
    }
}
