<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
 * Class PixelOfferDto
 */
class PixelOfferDto
{
    private int $id;
    private string $offerId;
    private string $title;
    private string $previewUrl;

    /**
     * PixelOfferDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->offerId = $attributes['offer_id'];
        $this->title = $attributes['title'];
        $this->previewUrl = $attributes['preview_url'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOfferId(): string
    {
        return $this->offerId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPreviewUrl(): string
    {
        return $this->previewUrl;
    }
}
