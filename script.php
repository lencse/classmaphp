#!/usr/bin/env php
<?php

namespace App;

use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Adapter\Processing\LocalFileSystemPackageProcessor;
use Lencse\ClassMap\Processing\ParsingFileProcessor;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);

//$processor = new LocalFileSystemPackageProcessor(__DIR__ . '/symfony');
$fileProcessor = new ParsingFileProcessor(new Parser());
(new LocalFileSystemPackageProcessor(__DIR__))->processPhpFiles($fileProcessor);

foreach ($fileProcessor->getNamespaces() as $namespace) {
    echo '\\'. $namespace->getName() . PHP_EOL;
    foreach ($namespace->getDependencies() as $dependency) {
        echo '    \\' . $dependency->getName() . PHP_EOL;
    }
}
