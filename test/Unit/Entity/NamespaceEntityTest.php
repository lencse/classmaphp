<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\NamespaceEntity;
use Lencse\ClassMap\Entity\PackageEntity;
use PHPUnit\Framework\TestCase;

class NamespaceEntityTest extends TestCase
{
    public function testNamespaceAttributes()
    {
        $namespace = new NamespaceEntity(new PackageEntity('lencse/classmaphp'), 'Test\\Entity');
        $this->assertEquals('lencse/classmaphp', $namespace->getPackage()->getId());
        $this->assertEquals('Test\\Entity', $namespace->getId());
    }
}
