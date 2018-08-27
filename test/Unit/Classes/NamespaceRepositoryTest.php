<?php

namespace Test\Unit\Classes;

use Lencse\ClassMap\Classes\NamespaceEntity;
use Lencse\ClassMap\Classes\NamespaceKey;
use Lencse\ClassMap\Classes\NamespaceRepository;
use PHPUnit\Framework\TestCase;

class NamespaceRepositoryTest extends TestCase
{
    public function testGet()
    {
        $repo = new NamespaceRepository();
        $namespace = $repo->get('Test');
        $this->assertEquals('Test', $namespace->getId());
        $this->assertSame($namespace, $repo->get('Test'));
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
