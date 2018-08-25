<?php

namespace Test\Unit\Entity;

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
}
