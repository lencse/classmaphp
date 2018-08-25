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

    public function testSamePackage()
    {
        $package1 = new PackageEntity('lencse/classmaphp');
        $package2 = new PackageEntity('lencse/classmaphp');
        $this->assertTrue($package1->same($package2));
    }

    public function testNonSamePackage()
    {
        $package1 = new PackageEntity('lencse/classmaphp');
        $package2 = new PackageEntity('lencse/other');
        $this->assertFalse($package1->same($package2));
    }
}
