<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class PartnerPaymentDto
*/
class PartnerPaymentDto
{

    /**
    * @var array<mixed>
    */
    private array $countries;

    /**
    * @var array<mixed>
    */
    private array $cities;

    /**
    * @var array<mixed>
    */
    private array $devices;

    /**
    * @var array<mixed>
    */
    private array $os;
    private string $goal;
    private float $total;
    private float $revenue;
    private string $currency;
    private string $title;
    private string $type;
    private ?string $url;
    private bool $countryExclude;
    private bool $withRegions;

    /**
    * @var array<int>
    */
    private array $partners;

    public function __construct(array $attributes)
    {
        $this->countries = $attributes['countries'] ?? [];
        $this->cities = $attributes['cities'] ?? [];
        $this->devices = $attributes['devices'] ?? [];
        $this->os = $attributes['os'] ?? [];
        $this->goal = $attributes['goal'];
        $this->total = $attributes['total'];
        $this->revenue = $attributes['revenue'];
        $this->currency = $attributes['currency'];
        $this->title = $attributes['title'];
        $this->type = $attributes['type'];
        $this->url = $attributes['url'] ?? null;
        $this->countryExclude = $attributes['country_exclude'];
        $this->withRegions = $attributes['with_regions'];
        $this->partners = $attributes['partners'] ?? [];
    }

    /**
    * @return array<mixed>
    */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
    * @return array<mixed>
    */
    public function getCities(): array
    {
        return $this->cities;
    }

    /**
    * @return array<mixed>
    */
    public function getDevices(): array
    {
        return $this->devices;
    }

    /**
    * @return array<mixed>
    */
    public function getOs(): array
    {
        return $this->os;
    }

    public function getGoal(): string
    {
        return $this->goal;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getRevenue(): float
    {
        return $this->revenue;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function isCountryExclude(): bool
    {
        return $this->countryExclude;
    }

    public function isWithRegions(): bool
    {
        return $this->withRegions;
    }

    /**
    * @return array<int>
    */
    public function getPartners(): array
    {
        return $this->partners;
    }
}
