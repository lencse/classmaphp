<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\Value\PHPClassList;

interface Parser
{
    public function parseAndExtendClassList(string $content, PHPClassList $classes): PHPClassList;
}
