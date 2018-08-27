<?php

namespace Test\Unit\Processing;

use Lencse\ClassMap\ClassData\ClassData;
use Lencse\ClassMap\ClassData\ClassDataList;
use Lencse\ClassMap\ClassData\StringList;
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
                    $handler->handle(new ClassData('Class1', '', new StringList()));
                }
                if ('content2' === $content) {
                    $handler->handle(new ClassData('Class2', '', new StringList()));
                }
            }
        });
        $processor->process('content1');
        $processor->process('content2');
        $processor->process('content3');

        $expected = [new ClassData('Class1', '', new StringList()), new ClassData('Class2', '', new StringList())];
        $this->assertEquals($expected, iterator_to_array($processor->getClassDataList()));
    }
}
