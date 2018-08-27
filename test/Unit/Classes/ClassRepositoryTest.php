<?php

namespace Test\Unit\Classes;

use Lencse\ClassMap\Classes\ClassRepository;
use Lencse\ClassMap\Classes\NamespaceEntity;
use Lencse\ClassMap\Classes\NamespaceKey;
use Lencse\ClassMap\Classes\NamespaceRepository;
use PHPUnit\Framework\TestCase;

class ClassRepositoryTest extends TestCase
{
    public function testGet()
    {
        $repo = new ClassRepository();
        $namespace1 = new NamespaceEntity('Test1');
        $namespace2 = new NamespaceEntity('Test2');
        $class1 = $repo->get($namespace1, 'Test1');
        $class2 = $repo->get($namespace1, 'Test2');
        $class3 = $repo->get($namespace2, 'Test1');
        $this->assertSame($class1, $repo->get($namespace1, 'Test1'));
        $this->assertSame($class2, $repo->get($namespace1, 'Test2'));
        $this->assertSame($class3, $repo->get($namespace2, 'Test1'));
    }
}
