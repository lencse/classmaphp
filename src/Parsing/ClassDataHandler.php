<?php

namespace Lencse\ClassMap\Parsing;

use Lencse\ClassMap\ClassData\FileInfo;

interface ClassDataHandler
{
    public function handle(FileInfo $classData): void;
}
