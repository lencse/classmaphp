<?php

namespace Lencse\ClassMap\Entity;

final class NamespaceEntity
{
    /**
     * @var PackageEntity
     */
    private $package;

    /**
     * @var string
     */
    private $id;

    public function __construct(PackageEntity $package, string $id)
    {
        $this->package = $package;
        $this->id = $id;
    }

    public function getPackage(): PackageEntity
    {
        return $this->package;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
