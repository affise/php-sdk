<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class CapDto
*/
class CapDto
{
    private string $period;
    private string $type;
    private int $value;
    private string $goalType;

    /**
    * @var array<string>
    */
    private array $goals;
    private ?string $affiliateType;

    /**
    * @var array<int>
    */
    private array $affiliates;

    /**
     * @var array<string>
     */
    private array $country;
    private ?string $countryType;

    public function __construct(array $attributes)
    {
        $this->period = $attributes['period'];
        $this->type = $attributes['type'];
        $this->value = $attributes['value'];
        $this->goalType = $attributes['goal_type'];
        $this->goals = $attributes['goals'] ?? [];
        $this->affiliateType = $attributes['affiliate_type'] ?? null;
        $this->affiliates = $attributes['affiliates'] ?? [];
        $this->country = empty($attributes['country']) ? [] : $attributes['country'];
        $this->countryType = $attributes['country_type'] ?? null;
    }

    public function getPeriod(): string
    {
        return $this->period;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getGoalType(): string
    {
        return $this->goalType;
    }

    /**
    * @return array<string>
    */
    public function getGoals(): array
    {
        return $this->goals;
    }

    public function getAffiliateType(): ?string
    {
        return $this->affiliateType;
    }

    /**
    * @return array<int>
    */
    public function getAffiliates(): array
    {
        return $this->affiliates;
    }

    /**
     * @return array<string>
     */
    public function getCountry(): array
    {
        return $this->country;
    }

    public function getCountryType(): ?string
    {
        return $this->countryType;
    }
}
