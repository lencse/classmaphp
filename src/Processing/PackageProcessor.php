<?php

namespace Lencse\ClassMap\Processing;

interface PackageProcessor
{
    public function processPhpFiles(FileProcessor $fileProcessor): void;
}
