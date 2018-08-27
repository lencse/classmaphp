<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\ClassData\ClassDataList;

interface Parser
{
    public function parse(string $content): ClassDataList;
}
