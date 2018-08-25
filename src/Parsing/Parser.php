<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\Value\ClassDataList;

interface Parser
{
    public function parseAndExtendClassList(string $content, ClassDataList $classes): ClassDataList;
}
