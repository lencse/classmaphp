#!/usr/bin/env php
<?php

namespace App;

use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Adapter\Processing\LocalFileSystemPackageProcessor;
use Lencse\ClassMap\Classes\ClassRepository;
use Lencse\ClassMap\Classes\NamespaceKey;
use Lencse\ClassMap\Classes\NamespaceRepository;
use Lencse\ClassMap\Processing\ParsingFileProcessor;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);

//$processor = new LocalFileSystemPackageProcessor(__DIR__ . '/symfony');
$processor = new LocalFileSystemPackageProcessor(__DIR__);
$fileProcessor = new ParsingFileProcessor(new Parser());
$processor->processPhpFiles($fileProcessor);

$namespaces = new NamespaceRepository();
$classes = new ClassRepository();

foreach ($fileProcessor->getClassDataList() as $classData) {
    $namespace = $namespaces->get(new NamespaceKey($classData->getNamespace()));
    $depClasses = [];
    foreach ($classData->getDependencies() as $dependency) {
        $explode = explode('\\', $dependency);
        $ns = implode('\\', array_slice($explode, 0, count($explode) - 1));
        $cl = array_pop($explode);
        $depNamespace = $namespaces->get(new NamespaceKey($ns));
        $depClasses[] = $classes->get($depNamespace, $cl);
    }
    $class = $classes->get($namespace, $classData->getName());
    foreach ($depClasses as $depClass) {
        $class->addDependency($depClass);
    }
}

foreach ($namespaces->getNamespaces() as $namespace) {
    echo '\\'. $namespace->getId() . PHP_EOL;
    foreach ($namespace->getNamespaceDependencies() as $dependency) {
        echo '    \\' . $dependency->getId() . PHP_EOL;
    }
}
