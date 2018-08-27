#!/usr/bin/env php
<?php

namespace App;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\ClassData\ClassDataList;
use Lencse\ClassMap\Classes\ClassEntity;
use Lencse\ClassMap\Classes\NamespaceEntity;
use Lencse\ClassMap\Processing\PackageProcessor;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);

$files = new Filesystem(new Local(__DIR__ /*. '/symfony'*/));

$composer = json_decode($files->read('composer.json'), true);

$dirs = $composer['autoload']['psr-4'];

$processor = new PackageProcessor(new Parser());

foreach ($dirs as $dir) {
    foreach ($files->listContents($dir, true) as $fileData) {
        if ('file' === $fileData['type'] && isset($fileData['extension']) && 'php' === $fileData['extension']) {
            $processor->process($files->read($fileData['path']));
        }
    }
}

/** @var NamespaceEntity[] $namespaces */
$namespaces = [];
/** @var ClassEntity $classes */
$classes = [];

foreach ($processor->getClassDataList() as $classData) {
    $namespace = new NamespaceEntity($classData->getNamespace());
    if (!isset($namespaces[$namespace->getKey()])) {
        $namespaces[$namespace->getKey()] = $namespace;
    }
    $depClasses = [];
    foreach ($classData->getDependencies() as $dependency) {
        $explode = explode('\\', $dependency);
        $ns = implode('\\', array_slice($explode, 0, count($explode) - 1));
        $cl = array_pop($explode);
        $dpn = new NamespaceEntity($ns);
        if (!isset($namespaces[$dpn->getKey()])) {
            $namespaces[$dpn->getKey()] = $dpn;
        }
        $depNamespace = $namespaces[$dpn->getKey()];
        $dpc = new ClassEntity($depNamespace, $cl);
        if (!isset($classes[$dpc->getKey()])) {
            $classes[$dpc->getKey()] = $dpc;
        }
        $depClasses[] = $classes[$dpc->getKey()];
    }
    $cla = new ClassEntity($namespaces[$namespace->getKey()], $classData->getName());
    if (!isset($classes[$cla->getKey()])) {
        $classes[$cla->getKey()] = $cla;
    }
    $class = $classes[$cla->getKey()];
    foreach ($depClasses as $depClass) {
        $class->addDependency($depClass);
    }
}

//echo 1;

foreach ($namespaces as $namespace) {
    echo '\\'. $namespace->getId() . PHP_EOL;
    foreach ($namespace->getNamespaceDependencies() as $dependency) {
        echo '    \\' . $dependency->getId() . PHP_EOL;
    }
}
