<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\Entity\PHPClass;

interface Parser
{
    public function parse(string $content): PHPClass;
}
