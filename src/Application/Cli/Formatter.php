<?php

namespace Lencse\ClassMap\Application\Cli;

use Lencse\ClassMap\Classes\NamespaceEntityCollection;

interface Formatter
{
    public function print(NamespaceEntityCollection $namespaces, Output $output): void;
}
