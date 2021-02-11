<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class OffersListPartnerDto
*/
class OffersListPartnerDto extends BaseOfferDto
{
    private ?string $impressionsLink;

    /**
    * @var array<\Affise\Sdk\Offers\LinkDto>
    */
    private array $links;
    private string $link;
    private string $clickSession;
    private string $minimalClickSession;
    private bool $considerPersonalTargetingOnly;
    private bool $hostsOnly;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
        
        $this->impressionsLink = $attributes['impressions_link'] ?? null;
        $this->links = array_map(fn(array $item) => new LinkDto($item), $attributes['links'] ?? []);
        $this->link = $attributes['link'];
        $this->clickSession = $attributes['click_session'];
        $this->minimalClickSession = $attributes['minimal_click_session'];
        $this->considerPersonalTargetingOnly = $attributes['consider_personal_targeting_only'];
        $this->hostsOnly = $attributes['hosts_only'];
    }

    /**
    * @return string|null
    */
    public function getImpressionsLink(): ?string
    {
        return $this->impressionsLink;
    }

    /**
    * @return array<\Affise\Sdk\Offers\LinkDto>
    */
    public function getLinks(): array
    {
        return $this->links;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getClickSession(): string
    {
        return $this->clickSession;
    }

    public function getMinimalClickSession(): string
    {
        return $this->minimalClickSession;
    }

    public function getConsiderPersonalTargetingOnly(): bool
    {
        return $this->considerPersonalTargetingOnly;
    }

    public function getHostsOnly(): bool
    {
        return $this->hostsOnly;
    }
}
