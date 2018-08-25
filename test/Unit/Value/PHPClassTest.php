<?php

namespace Test\Unit\Value;

use Lencse\ClassMap\Value\PHPClass;
use PHPUnit\Framework\TestCase;

class PHPClassTest extends TestCase
{
    public function testClass()
    {
        $class = new PHPClass('ClassName');
        $this->assertEquals('ClassName', $class->getName());
    }
}