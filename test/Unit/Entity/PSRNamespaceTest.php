<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\PSRNamespace;
use PHPUnit\Framework\TestCase;

class PSRNamespaceTest extends TestCase
{
    public function testGetId()
    {
        $namespace = new PSRNamespace('Something');
        $this->assertEquals('Something', $namespace->getId());
    }
}
