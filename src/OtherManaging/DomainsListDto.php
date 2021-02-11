<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class DomainsListDto
*/
class DomainsListDto
{
    private int $id;
    private string $url;
    private bool $useHttps;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->url = $attributes['url'];
        $this->useHttps = $attributes['use_https'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUseHttps(): bool
    {
        return $this->useHttps;
    }
}
