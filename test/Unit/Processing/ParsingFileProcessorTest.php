<?php

namespace Test\Unit\Processing;

use Lencse\ClassMap\ClassData\FileInfo;
use Lencse\ClassMap\ClassData\StringList;
use Lencse\ClassMap\Classes\NamespaceEntity;
use Lencse\ClassMap\Parsing\ClassDataHandler;
use Lencse\ClassMap\Parsing\Parser;
use Lencse\ClassMap\Processing\ParsingFileProcessor;
use PHPUnit\Framework\TestCase;

class ParsingFileProcessorTest extends TestCase
{
    public function testProcessing()
    {
        $processor = new ParsingFileProcessor(new class() implements Parser {
            public function parse(string $content, ClassDataHandler $handler): void
            {
                if ('content1' === $content) {
                    $handler->handle(
                        new FileInfo('Namespace1', (new StringList())->add('Namespace3\Class1'))
                    );
                }
                if ('content2' === $content) {
                    $handler->handle(new FileInfo('Namespace2', new StringList()));
                }
                if ('content4' === $content) {
                    $handler->handle(new FileInfo('Namespace4', (new StringList())->add('\\ClassInRoot')));
                }
            }
        });
        $processor->process('content1');
        $processor->process('content2');
        $processor->process('content3');
        $processor->process('content4');

        /** @var NamespaceEntity[] $arr */
        $arr = iterator_to_array($processor->getNamespaces());
        $this->assertEquals('Namespace1', $arr['Namespace1']->getName());
        $this->assertEquals('Namespace2', $arr['Namespace2']->getName());
        $this->assertEquals('Namespace3', $arr['Namespace3']->getName());
        $this->assertEquals(
            ['Namespace3' => $arr['Namespace3']],
            iterator_to_array($arr['Namespace1']->getDependencies())
        );
        $this->assertEquals(
            ['\\' => $arr['\\']],
            iterator_to_array($arr['Namespace4']->getDependencies())
        );
    }
}
