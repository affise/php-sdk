<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class PixelDto
*/
class PixelDto
{
    private int $id;
    private string $name;
    private string $code;
    private string $codeType;
    private int $offerId;
    private PixelOfferDto $offer;
    private int $pid;
    private bool $isActive;
    private bool $moderationStatus;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->code = $attributes['code'];
        $this->codeType = $attributes['code_type'];
        $this->offerId = (int) $attributes['offer_id'];
        $this->offer = new PixelOfferDto($attributes['offer']);
        $this->pid = (int) $attributes['pid'];
        $this->isActive = (bool) $attributes['is_active'];
        $this->moderationStatus = (bool) $attributes['moderation_status'];
        $this->createdAt = $attributes['created_at'];
        $this->updatedAt = $attributes['updated_at'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCodeType(): string
    {
        return $this->codeType;
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getOffer(): PixelOfferDto
    {
        return $this->offer;
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getModerationStatus(): bool
    {
        return $this->moderationStatus;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
