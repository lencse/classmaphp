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
        $this->classes = [
            new ClassEntity($this->namespaces[0], $this->classNames[0]),
            new ClassEntity($this->namespaces[0], $this->classNames[1]),
            new ClassEntity($this->namespaces[0], $this->classNames[2]),
            new ClassEntity($this->namespaces[1], $this->classNames[0]),
            new ClassEntity($this->namespaces[1], $this->classNames[1]),
            new ClassEntity($this->namespaces[1], $this->classNames[2]),
        ];
    }
}
