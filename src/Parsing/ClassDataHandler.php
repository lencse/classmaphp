<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\ClassData\ClassData;

interface ClassDataHandler
{
    public function handle(ClassData $classData): void;
}
