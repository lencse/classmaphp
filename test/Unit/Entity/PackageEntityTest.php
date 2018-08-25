<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\PackageEntity;
use PHPUnit\Framework\TestCase;

class PackageEntityTest extends TestCase
{
    public function testPackageAttributes()
    {
        $package = new PackageEntity('lencse/classmaphp');
        $this->assertEquals('lencse/classmaphp', $package->getId());
    }
}
