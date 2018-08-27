<?php

namespace Lencse\ClassMap\Parsing;

interface Parser
{
    public function parse(string $content, ClassDataHandler $handler): void;
}
