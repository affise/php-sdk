<?php

declare(strict_types=1);

namespace Affise\Sdk\Presets;

/**
* Class PresetDto
*/
class PresetDto
{
    private string $id;
    private string $name;

    /**
    * @var array<string, mixed>
    */
    private array $permissions;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->permissions = $attributes['permissions'] ?? [];
        $this->createdAt = $attributes['created_at'];
        $this->updatedAt = $attributes['updated_at'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
    * @return array<string, mixed>
    */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
