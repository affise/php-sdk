<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class SmartLinkCategoryDto
*/
class SmartLinkCategoryDto
{
    private string $id;
    private string $name;
    private string $domain;
    private ?string $description;
    private string $createdAt;
    private ?string $updatedAt;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['_id'];
        $this->name = $attributes['name'];
        $this->domain = $attributes['domain'];
        $this->description = $attributes['description'] ?? null;
        $this->createdAt = $attributes['created_at'];
        $this->updatedAt = $attributes['updated_at'] ?? null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
