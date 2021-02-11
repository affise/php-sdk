<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

class UserDto
{
    public const TYPE_COMMON_MANAGER = 'common_manager';
    public const TYPE_AFFILIATE_MANAGER = 'affiliate_manager';
    public const TYPE_ACCOUNT_MANAGER = 'account_manager';

    private string $id;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $workHours;
    private ?string $email;
    private ?string $skype;
    private ?string $apiKey;

    /**
     * @var array<string>
     * @psalm-var array<\Affise\Sdk\User\Role::ROLE_*>
     */
    private ?array $roles;
    private ?string $updatedAt;
    private ?string $createdAt;
    private ?string $lastLoginAt;
    private ?string $type;
    private ?string $avatar;

    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->firstName = $attributes['first_name'] ?? null;
        $this->lastName = $attributes['last_name'] ?? null;
        $this->workHours = $attributes['work_hours'] ?? null;
        $this->email = $attributes['email'] ?? null;
        $this->skype = $attributes['skype'] ?? null;
        $this->apiKey = $attributes['api_key'] ?? null;
        $this->roles = $attributes['roles'] ?? null;
        $this->updatedAt = $attributes['updated_at'] ?? null;
        $this->createdAt = $attributes['created_at'] ?? null;
        $this->lastLoginAt = $attributes['last_login_at'] ?? null;
        $this->type = $attributes['type'] ?? null;
        $this->avatar = $attributes['avatar'] ?? null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getWorkHours(): ?string
    {
        return $this->workHours;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getSkype(): ?string
    {
        return $this->skype;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @return array<string>|null
     * @psalm-return array<\Affise\Sdk\User\Role::ROLE_*>
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getLastLoginAt(): ?string
    {
        return $this->lastLoginAt;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
}
