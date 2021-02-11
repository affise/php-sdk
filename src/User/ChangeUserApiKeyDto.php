<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use InvalidArgumentException;

class ChangeUserApiKeyDto
{
    private string $id;
    private string $apiKey;

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

        if (empty($attributes['api_key'])) {
            throw new InvalidArgumentException("Key 'api_key' cannot be empty");
        }

        $this->id = $attributes['id'];
        $this->apiKey = $attributes['api_key'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}