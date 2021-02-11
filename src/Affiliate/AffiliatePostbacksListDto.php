<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

/**
* Class AffiliatePostbacksListDto
*/
class AffiliatePostbacksListDto
{
    private int $id;
    private string $url;
    private string $offerId;
    private string $status;
    private string $goal;
    private string $created;
    private string $forced;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->url = $attributes['url'];
        $this->offerId = $attributes['offer_id'];
        $this->status = $attributes['status'];
        $this->goal = $attributes['goal'];
        $this->created = $attributes['created'];
        $this->forced = $attributes['forced'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getOfferId(): string
    {
        return $this->offerId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getGoal(): string
    {
        return $this->goal;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function getForced(): string
    {
        return $this->forced;
    }
}
