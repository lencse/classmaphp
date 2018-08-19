<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\PHPClass;
use PHPUnit\Framework\TestCase;

class PHPClassTest extends TestCase
{
    public function testClass()
    {
        $class = new PHPClass('ClassName', 'Root\\Namespace');
        $this->assertEquals('ClassName', $class->getName());
        $this->assertEquals('Root\\Namespace', $class->getNamespace());
    }
}
