<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use InvalidArgumentException;

class ReadUserDto extends UserDto
{
    private ?string $info;

    /**
     * @var array<string, string>
     */
    private array $contacts;

    /**
     * @var array<string, mixed>
     */
    private array $permissions;

    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->info = $attributes['info'] ?? null;
        $this->contacts = empty($attributes['contacts']) ? [] : $attributes['contacts'];
        $this->permissions = empty($attributes['permissions']) ? [] : $attributes['permissions'];
    }

    public function getInfo(): ?string
    {
        return $this->info;
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
}