<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class StatDto
*/
class StatDto
{
    private string $affiliateType;

    /**
    * @var array<mixed>
    */
    private array $affiliates;

    /**
    * @var array<string>
    */
    private array $countries;
    private string $countryType;
    private int $currentValue;

    /**
    * @var array<mixed>
    */
    private array $goalStats;
    private string $goalType;

    /**
    * @var array<mixed>
    */
    private array $goals;
    private string $id;
    private bool $isRemaining;
    private int $resetToValue;
    private string $timeframe;
    private string $type;
    private int $value;

    public function __construct(array $attributes)
    {
        $this->affiliateType = $attributes['affiliate_type'];
        $this->affiliates = $attributes['affiliates'] ?? [];
        $this->countries = $attributes['countries'] ?? [];
        $this->countryType = $attributes['country_type'];
        $this->currentValue = $attributes['current_value'];
        $this->goalStats = $attributes['goal_stats'] ?? [];
        $this->goalType = $attributes['goal_type'];
        $this->goals = $attributes['goals'] ?? [];
        $this->id = $attributes['id'];
        $this->isRemaining = $attributes['is_remaining'];
        $this->resetToValue = $attributes['reset_to_value'];
        $this->timeframe = $attributes['timeframe'];
        $this->type = $attributes['type'];
        $this->value = $attributes['value'];
    }

    public function getAffiliateType(): string
    {
        return $this->affiliateType;
    }

    /**
    * @return array<mixed>
    */
    public function getAffiliates(): array
    {
        return $this->affiliates;
    }

    /**
    * @return array<string>
    */
    public function getCountries(): array
    {
        return $this->countries;
    }

    public function getCountryType(): string
    {
        return $this->countryType;
    }

    public function getCurrentValue(): int
    {
        return $this->currentValue;
    }

    /**
    * @return array<mixed>
    */
    public function getGoalStats(): array
    {
        return $this->goalStats;
    }

    public function getGoalType(): string
    {
        return $this->goalType;
    }

    /**
    * @return array<mixed>
    */
    public function getGoals(): array
    {
        return $this->goals;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIsRemaining(): bool
    {
        return $this->isRemaining;
    }

    public function getResetToValue(): int
    {
        return $this->resetToValue;
    }

    public function getTimeframe(): string
    {
        return $this->timeframe;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
