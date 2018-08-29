<?php

namespace Test\Unit\Adapter\Parsing;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\ClassData\FileInfo;
use Lencse\ClassMap\ClassData\StringList;
use Lencse\ClassMap\Parsing\ClassDataHandler;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase implements ClassDataHandler
{
    /**
     * @var FileInfo[]
     */
    private $classes = [];

    public function testParsingClassWithoutDependencies()
    {
        $classes = $this->generateClassArrayFromFile('EventDispatcher.php');
        $this->assertEquals('Symfony\\Component\\EventDispatcher', $classes[0]->getNamespace());
        $this->assertEquals(new StringList(), $classes[0]->getDependencies());
    }

    public function testParsingClassWthDependencies()
    {
        $classes = $this->generateClassArrayFromFile('ExpressionLanguage.php');
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

    public function testParsingClassesWithoutNamespace()
    {
        $classes = $this->generateClassArrayFromFile('SymfonyRequirements.php');
        $this->assertEmpty($classes);
    }

    public function testParsingEmptyFiles()
    {
        $classes = $this->generateClassArrayFromFile('empty.php');
        $this->assertEmpty($classes);
    }

    public function handle(FileInfo $classData): void
    {
        $this->classes[] = $classData;
    }

    /**
     * @param string $path
     *
     * @return FileInfo[]
     */
    private function generateClassArrayFromFile(string $path): array
    {
        $files = new Filesystem(new Local(__DIR__ . '/../../../fixtures/files'));
        $parser = new Parser();
        $content = $files->read($path);
        $this->classes = [];
        $parser->parse($content, $this);

        return $this->classes;
    }
}
