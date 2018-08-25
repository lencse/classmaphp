<?php

namespace Test\Unit\Adapter\Parsing;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Value\NamespaceId;
use Lencse\ClassMap\Value\PHPClass;
use Lencse\ClassMap\Value\PHPClassList;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParsingClass()
    {
        $classes = $this->generateClassArrayFromFile('EventDispatcher.php');
        $this->assertEquals('EventDispatcher', $classes[0]->getName());
        $this->assertEquals('Symfony\\Component\\EventDispatcher', $classes[0]->getNamespace());
    }

    public function testParsingNonClasses()
    {
        $classes = $this->generateClassArrayFromFile('index.php');
        $this->assertEmpty($classes);
    }

    public function testParsingEmptyFiles()
    {
        $classes = $this->generateClassArrayFromFile('empty.php');
        $this->assertEmpty($classes);
    }

    /**
     * @param string $path
     * @return PHPClass[]
     */
    private function generateClassArrayFromFile(string $path): array
    {
        $files = new Filesystem(new Local(__DIR__ . '/../../../fixtures'));
        $parser = new Parser();
        $content = $files->read($path);
        $classes = $parser->parseAndExtendClassList($content, new PHPClassList());

        return iterator_to_array($classes);
    }
}
