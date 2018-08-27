<?php

namespace Lencse\ClassMap\Processing;

interface FileProcessor
{
    public function process(string $content): void;
}
