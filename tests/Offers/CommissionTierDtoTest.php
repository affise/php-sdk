<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class CommissionTierDtoTest
 */
class CommissionTierDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'affiliate_type' => 'exact',
            'affiliates' => [1],
            'goals' => [],
            'timeframe' => 'month',
            'type' => 'budget',
            'value' => 55.6,
            'target_goals' => [],
            'modifier_type' => 'to_percent',
            'modifier_value' => 10.02,
            'modifier_payment_type' => 'payout',
        ];
    }

    public function testGetAffiliateType(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals('exact', $commissionTierDto->getAffiliateType());
    }

    public function testGetAffiliates(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals([1], $commissionTierDto->getAffiliates());
    }

    public function testGetGoals(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals([], $commissionTierDto->getGoals());
    }

    public function testGetTimeframe(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals('month', $commissionTierDto->getTimeframe());
    }

    public function testGetType(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals('budget', $commissionTierDto->getType());
    }

    public function testGetValue(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals(55.6, $commissionTierDto->getValue());
    }

    public function testGetTargetGoals(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals([], $commissionTierDto->getTargetGoals());
    }

    public function testGetModifierType(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals('to_percent', $commissionTierDto->getModifierType());
    }

    public function testGetModifierValue(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals(10.02, $commissionTierDto->getModifierValue());
    }

    public function testGetModifierPaymentType(): void
    {
        $commissionTierDto = new CommissionTierDto(static::$requiredAttributes);

        $this->assertEquals('payout', $commissionTierDto->getModifierPaymentType());
    }
}
