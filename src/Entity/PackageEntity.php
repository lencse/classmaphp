<?php

namespace Lencse\ClassMap\Entity;

final class PackageEntity implements HasKey
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function same(self $other): bool
    {
        return $other->getId() === $this->getId();
    }

    public function getKey(): string
    {
        return $this->getId();
    }
}
