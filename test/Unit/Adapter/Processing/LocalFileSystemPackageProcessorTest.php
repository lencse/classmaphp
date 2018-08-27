<?php

namespace Test\Unit\Adapter\Processing;

use Lencse\ClassMap\Adapter\Processing\LocalFileSystemPackageProcessor;
use Lencse\ClassMap\Processing\FileProcessor;
use PHPUnit\Framework\TestCase;

class LocalFileSystemPackageProcessorTest extends TestCase implements FileProcessor
{
    /**
     * @var string[]
     */
    private $contents = [];

    public function testProcessing()
    {
        $processor = new LocalFileSystemPackageProcessor(__DIR__ . '/../../../fixtures/package');
        $processor->processPhpFiles($this);
        sort($this->contents);
        $this->assertEquals(['file2', 'file3', 'file4'], $this->contents);
    }

    public function process(string $content): void
    {
        $this->contents[] = $content;
    }
}
