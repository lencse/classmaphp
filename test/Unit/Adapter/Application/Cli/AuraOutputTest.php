<?php

namespace Test\Unit\Adapter\Application\Cli;

use Aura\Cli\Stdio;
use Lencse\ClassMap\Adapter\Application\Cli\AuraOutput;
use PHPUnit\Framework\TestCase;

class AuraOutputTest extends TestCase
{
    /**
     * @var string[]
     */
    public $lines = [];

    public function testPrintln()
    {
        $stdio = new class($this) extends Stdio {
            /**
             * @var AuraOutputTest
             */
            private $outputTest;

            public function __construct(AuraOutputTest $outputTest)
            {
                $this->outputTest = $outputTest;
            }

            public function outln($string = null)
            {
                $this->outputTest->lines[] = $string;
            }
        };
        $output = new AuraOutput($stdio);
        $output->println('Test1');
        $output->println('Test2');
        $this->assertEquals(['Test1', 'Test2'], $this->lines);
    }
}
