<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class LinkDto
*/
class LinkDto
{
    private ?string $id;
    private ?string $title;
    private ?string $hash;
    private string $url;

    /**
    * @var array<mixed>
    */
    private array $postbacks;
    private ?string $created;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'] ?? null;
        $this->title = $attributes['title'] ?? null;
        $this->hash = $attributes['hash'] ?? null;
        $this->url = $attributes['url'];
        $this->postbacks = $attributes['postbacks'] ?? [];
        $this->created = $attributes['created'] ?? null;
    }

    /**
    * @return string|null
    */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
    * @return string|null
    */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
    * @return string|null
    */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
    * @return array<mixed>
    */
    public function getPostbacks(): array
    {
        return $this->postbacks;
    }

    /**
    * @return string|null
    */
    public function getCreated(): ?string
    {
        return $this->created;
    }
}
