<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

/**
* Class ChangePartnerApiKeyDto
*/
class ChangePartnerApiKeyDto
{
    private int $id;
    private string $apiKey;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->apiKey = $attributes['api_key'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
