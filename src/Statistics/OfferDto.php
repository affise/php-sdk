<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class OfferDto
*/
class OfferDto
{
    private int $id;
    private string $title;
    private string $offerId;
    private string $url;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->offerId = $attributes['offer_id'];
        $this->url = $attributes['url'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOfferId(): string
    {
        return $this->offerId;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
