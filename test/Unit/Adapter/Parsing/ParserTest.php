<?php

namespace Test\Unit\Adapter\Parsing;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Value\PHPClass;
use Lencse\ClassMap\Value\PHPClassList;
use Lencse\ClassMap\Value\StringList;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParsingClassWithoutDependencies()
    {
        $classes = $this->generateClassArrayFromFile('EventDispatcher.php');
        $this->assertEquals('EventDispatcher', $classes[0]->getName());
        $this->assertEquals('Symfony\\Component\\EventDispatcher', $classes[0]->getNamespace());
        $this->assertEquals(new StringList(), $classes[0]->getDependencies());
    }

    public function testParsingClassWthDependencies()
    {
        $classes = $this->generateClassArrayFromFile('ExpressionLanguage.php');
        $this->assertEquals('ExpressionLanguage', $classes[0]->getName());
        $this->assertEquals('Symfony\\Component\\DependencyInjection', $classes[0]->getNamespace());
        $expected = [
            'Psr\\Cache\\CacheItemPoolInterface',
            'Symfony\\Component\\ExpressionLanguage\\ExpressionLanguage',
        ];
        $this->assertEquals($expected, iterator_to_array($classes[0]->getDependencies()));
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
     *
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
