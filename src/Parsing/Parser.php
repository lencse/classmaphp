<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\ClassData\ClassDataList;

interface Parser
{
    public function parseAndExtendClassList(string $content, ClassDataList $classes): ClassDataList;
}
