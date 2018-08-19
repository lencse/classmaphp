<?php

namespace Lencse\ClassMap\Entity;

final class RootNamespace implements PSRNamespace
{
    public function getId(): string
    {
        return '\\';
    }
}
