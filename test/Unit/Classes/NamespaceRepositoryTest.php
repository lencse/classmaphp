<?php

namespace Test\Unit\Classes;

use Lencse\ClassMap\Classes\ClassEntity;
use Lencse\ClassMap\Classes\NamespaceEntity;
use Lencse\ClassMap\Classes\NamespaceRepository;
use PHPUnit\Framework\TestCase;

class NamespaceRepositoryTest extends TestCase
{
    public function testGet()
    {
        $repo = new NamespaceRepository();
        $namespace1 = $repo->get('Test');
        $this->assertEquals('Test', $namespace1->getId());
        $namespace2 = $repo->get('Test');
        $this->assertSame($namespace1, $namespace2);
    }

    public function testGetNamespaces()
    {
        $repo = new NamespaceRepository();
        $repo->get('Test1');
        $repo->get('Test2');
        $this->assertEquals(
            [new NamespaceEntity('Test1'), new NamespaceEntity('Test2')],
            array_values(iterator_to_array($repo->getNamespaces()))
        );
    }
}
