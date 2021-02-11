<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use InvalidArgumentException;

class UpdateUserPermissionsDto
{
    private string $id;
    private string $email;
    private string $type;
    private string $firstName;
    private string $lastName;

    /**
     * @var array<string, string>
     */
    private array $contacts;

    /**
     * @var array<string, mixed>
     */
    private array $permissions;
    private ?string $workHours;
    private string $apiKey;
    private ?string $createdAt;
    private ?string $updatedAt;

    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        if (!$attributes) {
            throw new InvalidArgumentException('Attributes cannot be empty');
        }

        if (empty($attributes['id'])) {
            throw new InvalidArgumentException("Key 'id' cannot be empty");
        }

        if (empty($attributes['email'])) {
            throw new InvalidArgumentException("Key 'email' cannot be empty");
        }

        if (empty($attributes['type'])) {
            throw new InvalidArgumentException("Key 'type' cannot be empty");
        }

        if (empty($attributes['first_name'])) {
            throw new InvalidArgumentException("Key 'first_name' cannot be empty");
        }

        if (empty($attributes['last_name'])) {
            throw new InvalidArgumentException("Key 'last_name' cannot be empty");
        }

        if (empty($attributes['contacts'])) {
            throw new InvalidArgumentException("Key 'contacts' cannot be empty");
        }

        if (empty($attributes['permissions'])) {
            throw new InvalidArgumentException("Key 'permissions' cannot be empty");
        }

        if (empty($attributes['api_key'])) {
            throw new InvalidArgumentException("Key 'api_key' cannot be empty");
        }

        $this->id = $attributes['id'];
        $this->email = $attributes['email'];
        $this->type = $attributes['type'];
        $this->firstName = $attributes['first_name'];
        $this->lastName = $attributes['last_name'];
        $this->contacts = $attributes['contacts'];
        $this->permissions = $attributes['permissions'];
        $this->workHours = $attributes['work_hours'] ?? null;
        $this->apiKey = $attributes['api_key'];
        $this->createdAt = $attributes['created_at'] ?? null;
        $this->updatedAt = $attributes['updated_at'] ?? null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return array<string, string>
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @return array<string, mixed>
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getWorkHours(): ?string
    {
        return $this->workHours;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}