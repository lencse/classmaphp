<?php

namespace Lencse\ClassMap\Adapter\Application\Cli;

use Aura\Cli\Stdio;
use Lencse\ClassMap\Application\Cli\Output;

/**
 * @codeCoverageIgnore
 */
class AuraOutput implements Output
{
    /**
     * @var Stdio
     */
    private $stdio;

    public function __construct(Stdio $stdio)
    {
        $this->stdio = $stdio;
    }

    public function println(string $str): void
    {
        $this->stdio->outln($str);
    }
}
