<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use InvalidArgumentException;

class ChangeUserPasswordDto
{
    private string $id;
    private string $password;

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

        if (empty($attributes['password'])) {
            throw new InvalidArgumentException("Key 'password' cannot be empty");
        }

        $this->id = $attributes['id'];
        $this->password = $attributes['password'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}