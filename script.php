#!/usr/bin/env php
<?php

namespace App;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Lencse\ClassMap\Adapter\Parsing\Parser;
use Lencse\ClassMap\Data\ClassDataList;
use Lencse\ClassMap\Entity\ClassEntity;
use Lencse\ClassMap\Entity\NamespaceEntity;
use Lencse\ClassMap\Entity\PackageEntity;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);

$files = new Filesystem(new Local(__DIR__ /*. '/symfony'*/));

$composer = json_decode($files->read('composer.json'), true);

$package = new PackageEntity($composer['name']);

$dirs = $composer['autoload']['psr-4'];

$parser = new Parser();

$classDataList = new ClassDataList();

foreach ($dirs as $dir) {
    foreach ($files->listContents($dir, true) as $fileData) {
        if ('file' === $fileData['type'] && isset($fileData['extension']) && 'php' === $fileData['extension']) {
            $classDataList = $parser->parseAndExtendClassList($files->read($fileData['path']), $classDataList);
        }
    }
}

/** @var NamespaceEntity[] $namespaces */
$namespaces = [];
/** @var ClassEntity $classes */
$classes = [];

foreach ($classDataList as $classData) {
    $namespace = new NamespaceEntity($package, $classData->getNamespace());
    if (!isset($namespaces[$namespace->getKey()])) {
        $namespaces[$namespace->getKey()] = $namespace;
    }
    $depClasses = [];
    foreach ($classData->getDependencies() as $dependency) {
        $explode = explode('\\', $dependency);
        $ns = implode('\\', array_slice($explode, 0, count($explode) - 1));
        $cl = array_pop($explode);
        $dpn = new NamespaceEntity($package, $ns);
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