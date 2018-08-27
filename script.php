#!/usr/bin/env php
<?php

namespace App;

use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Adapter\Processing\LocalFileSystemPackageProcessor;
use Lencse\ClassMap\Processing\ParsingFileProcessor;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);

//$processor = new LocalFileSystemPackageProcessor(__DIR__ . '/symfony');
$processor = new LocalFileSystemPackageProcessor(__DIR__);
$fileProcessor = new ParsingFileProcessor(new Parser());
$processor->processPhpFiles($fileProcessor);

foreach ($fileProcessor->getNamespaceRepository()->getNamespaces() as $namespace) {
    echo '\\'. $namespace->getId() . PHP_EOL;
    foreach ($namespace->getNamespaceDependencies() as $dependency) {
        echo '    \\' . $dependency->getId() . PHP_EOL;
    }
}
