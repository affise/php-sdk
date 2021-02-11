<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class CommissionTierDto
*/
class CommissionTierDto
{
    private string $affiliateType;

    /**
    * @var array<int>
    */
    private array $affiliates;

    /**
    * @var array<mixed>
    */
    private array $goals;
    private string $timeframe;
    private string $type;
    private float $value;

    /**
    * @var array<mixed>
    */
    private array $targetGoals;
    private string $modifierType;
    private float $modifierValue;
    private string $modifierPaymentType;

    public function __construct(array $attributes)
    {
        $this->affiliateType = $attributes['affiliate_type'];
        $this->affiliates = $attributes['affiliates'] ?? [];
        $this->goals = $attributes['goals'] ?? [];
        $this->timeframe = $attributes['timeframe'];
        $this->type = $attributes['type'];
        $this->value = $attributes['value'];
        $this->targetGoals = $attributes['target_goals'] ?? [];
        $this->modifierType = $attributes['modifier_type'];
        $this->modifierValue = $attributes['modifier_value'];
        $this->modifierPaymentType = $attributes['modifier_payment_type'];
    }

    public function getAffiliateType(): string
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
    * @return array<mixed>
    */
    public function getGoals(): array
    {
        return $this->goals;
    }

    public function getTimeframe(): string
    {
        return $this->timeframe;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    /**
    * @return array<mixed>
    */
    public function getTargetGoals(): array
    {
        return $this->targetGoals;
    }

    public function getModifierType(): string
    {
        return $this->modifierType;
    }

    public function getModifierValue(): float
    {
        return $this->modifierValue;
    }

    public function getModifierPaymentType(): string
    {
        return $this->modifierPaymentType;
    }
}
