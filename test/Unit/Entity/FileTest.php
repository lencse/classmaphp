<?php

namespace Test\Unit\Entity;

use Lencse\ClassMap\Entity\File;
use Lencse\ClassMap\Entity\SubNamespace;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testRootNamespace()
    {
        $file = new File('');
        $this->assertEquals('\\', $file->getNamespace()->getId());
    }

    public function testNamespace()
    {
        $file = new File((string) file_get_contents(__DIR__ . '/fixtures/FileTest.php.test'));
        $this->assertEquals('Test\\Unit\\Entity', $file->getNamespace()->getId());
    }

    public function testDependenciese()
    {
        $file = new File((string) file_get_contents(__DIR__ . '/fixtures/FileTest.php.test'));
        $this->assertEquals(
            [
                new SubNamespace('Lencse\\ClassMap\\Entity'),
                new SubNamespace('PHPUnit\Framework'),
            ],
            iterator_to_array($file->getDependencies())
        );
    }
}
