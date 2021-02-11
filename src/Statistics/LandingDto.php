<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class LandingDto
*/
class LandingDto
{
    /**
     * @var int|string
     */
    private $id;
    private ?string $url;
    private ?string $title;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->url = $attributes['url'] ?? null;
        $this->title = $attributes['title'] ?? null;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
