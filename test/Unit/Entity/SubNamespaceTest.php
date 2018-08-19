<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\SubNamespace;
use PHPUnit\Framework\TestCase;

class SubNamespaceTest extends TestCase
{
    public function testId()
    {
        $namespace = new SubNamespace('Something');
        $this->assertEquals('Something', $namespace->getId());
    }
}
