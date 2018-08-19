<?php

namespace Lencse\ClassMap\Entity;

class RootNamespace implements PSRNamespace
{
    public function getId(): string
    {
        return '\\';
    }
}
