<?php

namespace Test\Unit\Processing;

use Lencse\ClassMap\ClassData\ClassData;
use Lencse\ClassMap\ClassData\ClassDataList;
use Lencse\ClassMap\ClassData\StringList;
use Lencse\ClassMap\Parsing\Parser;
use Lencse\ClassMap\Processing\PackageProcessor;
use PHPUnit\Framework\TestCase;

class PackageProcessorTest extends TestCase
{
    public function testProcessing()
    {
        $processor = new PackageProcessor(new class implements Parser {
            public function parse(string $content): ClassDataList
            {
                return  [
                    'content1' => (new ClassDataList())->add(new ClassData('Class1', '', new StringList())),
                    'content2' => (new ClassDataList())->add(new ClassData('Class2', '', new StringList())),
                ][$content] ?? new ClassDataList();
            }
        });
        $processor->process('content1');
        $processor->process('content2');
        $processor->process('content3');

        $expected = [new ClassData('Class1', '', new StringList()), new ClassData('Class2', '', new StringList())];
        $this->assertEquals($expected, iterator_to_array($processor->getClassDataList()));
    }
}
