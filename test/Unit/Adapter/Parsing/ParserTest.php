<?php

namespace Test\Unit\Adapter\Parsing;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Parsing\Exception\ClassNameNotParsedException;
use Lencse\ClassMap\Value\PHPClassList;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParsingClass()
    {
        $parser = new Parser();
        $content = $this->getFileContent('EventDispatcher.php');
        $classes = $parser->parseAndExtendClassList($content, new PHPClassList());
        $arr = iterator_to_array($classes);
        $this->assertEquals('EventDispatcher', $arr[0]->getName());
    }

    public function testParsingNonClasses()
    {
        $parser = new Parser();
        $content = $this->getFileContent('index.php');
        $classes = $parser->parseAndExtendClassList($content, new PHPClassList());
        $arr = iterator_to_array($classes);
        $this->assertEmpty($arr);
    }

    public function testParsingEmptyFiles()
    {
        $parser = new Parser();
        $content = $this->getFileContent('empty.php');
        $classes = $parser->parseAndExtendClassList($content, new PHPClassList());
        $arr = iterator_to_array($classes);
        $this->assertEmpty($arr);
    }

    private function getFileContent(string $path): string
    {
        $files = new Filesystem(new Local(__DIR__ . '/../../../fixtures'));
        return $files->read($path);
    }
}
