<?php

namespace Lencse\ClassMap\Application\Cli;

interface Output
{
    public function println(string $str): void;
}
