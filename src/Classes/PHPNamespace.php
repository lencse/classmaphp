<?php

namespace Lencse\ClassMap\Classes;

interface PHPNamespace
{
    public function getName(): string;

    public function getKey(): string;

    public function getDependencies(): PHPNamespaceList;
}
