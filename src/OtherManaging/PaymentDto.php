<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class PaymentDto
*/
class PaymentDto
{

    /**
    * @var array<mixed>
    */
    private array $countries;

    /**
    * @var array<mixed>
    */
    private array $cities;
    private bool $countryExclude;
    private string $title;
    private string $goal;
    private float $revenue;
    private string $currency;
    private string $type;

    /**
    * @var array<mixed>
    */
    private array $devices;

    /**
    * @var array<mixed>
    */
    private array $os;

    public function __construct(array $attributes)
    {
        $this->countries = $attributes['countries'] ?? [];
        $this->cities = $attributes['cities'] ?? [];
        $this->countryExclude = $attributes['country_exclude'];
        $this->title = $attributes['title'];
        $this->goal = $attributes['goal'];
        $this->revenue = $attributes['revenue'];
        $this->currency = $attributes['currency'];
        $this->type = $attributes['type'];
        $this->devices = $attributes['devices'] ?? [];
        $this->os = $attributes['os'] ?? [];
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

    public function getCountryExclude(): bool
    {
        return $this->countryExclude;
    }

    public function getTitle(): string
    {
        return $this->title;
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

    public function getType(): string
    {
        return $this->type;
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
}
