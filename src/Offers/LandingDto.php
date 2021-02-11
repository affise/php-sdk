<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class LandingDto
*/
class LandingDto
{
    private int $id;
    private string $title;
    private string $url;
    private string $urlPreview;
    private string $type;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->url = $attributes['url'];
        $this->urlPreview = $attributes['url_preview'];
        $this->type = $attributes['type'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUrlPreview(): string
    {
        return $this->urlPreview;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
