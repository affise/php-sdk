<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class PaymentDto
*/
class PaymentDto
{

    /**
    * @var array<string>
    */
    private array $countries;

    /**
    * @var array<\Affise\Sdk\Offers\CityDto>
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
    private float $revenue;
    private string $currency;
    private string $title;
    private string $type;
    private bool $countryExclude;
    private ?float $total;
    private ?bool $withRegions;
    private ?string $url;
    private ?string $sub1;
    private ?string $sub2;
    private ?string $sub3;
    private ?string $sub4;
    private ?string $sub5;
    private ?string $sub6;
    private ?string $sub7;
    private ?string $sub8;

    public function __construct(array $attributes)
    {
        $this->countries = $attributes['countries'] ?? [];
        $this->cities = array_map(fn(array $item) => new CityDto($item), $attributes['cities'] ?? []);
        $this->devices = $attributes['devices'] ?? [];
        $this->os = $attributes['os'] ?? [];
        $this->goal = $attributes['goal'];
        $this->revenue = $attributes['revenue'];
        $this->currency = $attributes['currency'];
        $this->title = $attributes['title'];
        $this->type = $attributes['type'];
        $this->countryExclude = $attributes['country_exclude'];
        $this->total = $attributes['total'] ?? null;
        $this->withRegions = $attributes['with_regions'] ?? null;
        $this->url = $attributes['url'] ?? null;
        $this->sub1 = $attributes['sub1'] ?? null;
        $this->sub2 = $attributes['sub2'] ?? null;
        $this->sub3 = $attributes['sub3'] ?? null;
        $this->sub4 = $attributes['sub4'] ?? null;
        $this->sub5 = $attributes['sub5'] ?? null;
        $this->sub6 = $attributes['sub6'] ?? null;
        $this->sub7 = $attributes['sub7'] ?? null;
        $this->sub8 = $attributes['sub8'] ?? null;
    }

    /**
    * @return array<string>
    */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
    * @return array<\Affise\Sdk\Offers\CityDto>
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

    public function isCountryExclude(): bool
    {
        return $this->countryExclude;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function isWithRegions(): ?bool
    {
        return $this->withRegions;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getSub1(): ?string
    {
        return $this->sub1;
    }

    public function getSub2(): ?string
    {
        return $this->sub2;
    }

    public function getSub3(): ?string
    {
        return $this->sub3;
    }

    public function getSub4(): ?string
    {
        return $this->sub4;
    }

    public function getSub5(): ?string
    {
        return $this->sub5;
    }

    public function getSub6(): ?string
    {
        return $this->sub6;
    }

    public function getSub7(): ?string
    {
        return $this->sub7;
    }

    public function getSub8(): ?string
    {
        return $this->sub8;
    }
}
