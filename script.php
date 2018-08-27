#!/usr/bin/env php
<?php

namespace App;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Adapter\Processing\LocalFileSystemPackageProcessor;
use Lencse\ClassMap\Classes\ClassEntity;
use Lencse\ClassMap\Classes\NamespaceKey;
use Lencse\ClassMap\Classes\NamespaceRepository;
use Lencse\ClassMap\Processing\ParsingFileProcessor;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);

$files = new Filesystem(new Local(__DIR__ /*. '/symfony'*/));

$composer = json_decode($files->read('composer.json'), true);

$dirs = $composer['autoload']['psr-4'];

$processor = new LocalFileSystemPackageProcessor(__DIR__);
$fileProcessor = new ParsingFileProcessor(new Parser());
$processor->processPhpFiles($fileProcessor);

$namespaces = new NamespaceRepository();
/** @var ClassEntity $classes */
$classes = [];

foreach ($fileProcessor->getClassDataList() as $classData) {
    $namespace = $namespaces->get(new NamespaceKey($classData->getNamespace()));
    $depClasses = [];
    foreach ($classData->getDependencies() as $dependency) {
        $explode = explode('\\', $dependency);
        $ns = implode('\\', array_slice($explode, 0, count($explode) - 1));
        $cl = array_pop($explode);
        $depNamespace = $namespaces->get(new NamespaceKey($ns));
        $dpc = new ClassEntity($depNamespace, $cl);
        if (!isset($classes[$dpc->getKey()])) {
            $classes[$dpc->getKey()] = $dpc;
        }
        $depClasses[] = $classes[$dpc->getKey()];
    }
    $cla = new ClassEntity($namespace, $classData->getName());
    if (!isset($classes[$cla->getKey()])) {
        $classes[$cla->getKey()] = $cla;
    }
    $class = $classes[$cla->getKey()];
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
