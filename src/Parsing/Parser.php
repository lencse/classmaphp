<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\ClassData\ClassData;
use Lencse\ClassMap\Parsing\ClassDataHandler;
use Lencse\ClassMap\ClassData\ClassDataList;

interface Parser
{
    public function parse(string $content, ClassDataHandler $handler): void;
}
