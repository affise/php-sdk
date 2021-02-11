<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class StatDtoTest
 */
class StatDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'affiliate_type' => 'string',
            'affiliates' => [],
            'countries' => ['string'],
            'country_type' => 'string',
            'current_value' => 0,
            'goal_stats' => [],
            'goal_type' => 'string',
            'goals' => [],
            'id' => 'string',
            'is_remaining' => true,
            'reset_to_value' => 0,
            'timeframe' => 'string',
            'type' => 'string',
            'value' => 0,
        ];
    }

    public function testGetAffiliateType(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals('string', $statDto->getAffiliateType());
    }

    public function testGetAffiliates(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals([], $statDto->getAffiliates());
    }

    public function testGetCountries(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals(['string'], $statDto->getCountries());
    }

    public function testGetCountryType(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals('string', $statDto->getCountryType());
    }

    public function testGetCurrentValue(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals(0, $statDto->getCurrentValue());
    }

    public function testGetGoalStats(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals([], $statDto->getGoalStats());
    }

    public function testGetGoalType(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals('string', $statDto->getGoalType());
    }

    public function testGetGoals(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals([], $statDto->getGoals());
    }

    public function testGetId(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals('string', $statDto->getId());
    }

    public function testGetIsRemaining(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals(true, $statDto->getIsRemaining());
    }

    public function testGetResetToValue(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals(0, $statDto->getResetToValue());
    }

    public function testGetTimeframe(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals('string', $statDto->getTimeframe());
    }

    public function testGetType(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals('string', $statDto->getType());
    }

    public function testGetValue(): void
    {
        $statDto = new StatDto(static::$requiredAttributes);

        $this->assertEquals(0, $statDto->getValue());
    }
}
