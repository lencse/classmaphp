<?php

namespace Test\Unit\Application\Cli;

use Lencse\ClassMap\Application\Cli\Output;
use Lencse\ClassMap\Application\Cli\ReadableFormatter;
use Lencse\ClassMap\Classes\NamespaceEntity;
use Lencse\ClassMap\Classes\NamespaceEntityCollection;
use PHPUnit\Framework\TestCase;

class ReadableFormatterTest extends TestCase implements Output
{
    /**
     * @var string[]
     */
    private $lines = [];

    public function testFormat()
    {
        $formatter = new ReadableFormatter();
        $ns1 = new NamespaceEntity('Namespace1');
        $ns2 = new NamespaceEntity('Namespace2');
        $ns1->addDependency($ns2);
        $namespaces = new NamespaceEntityCollection();
        $namespaces->add($ns1);
        $namespaces->add($ns2);
        $formatter->print($namespaces, $this);
        $this->assertEquals(
            [
                'Namespace1',
                '    Namespace2 (1)',
                'Namespace2',
            ],
            $this->lines
        );
    }

    public function println(string $str): void
    {
        $this->lines[] = $str;
    }
}
