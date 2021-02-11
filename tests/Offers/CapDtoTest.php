<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class CapDtoTest
 */
class CapDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'period' => 'day',
            'type' => 'conversions',
            'value' => 100,
            'goal_type' => 'exact',
            'goals' => ['Install'],
            'affiliates' => [500, 600],
        ];
    }

    public function testGetPeriod(): void
    {
        $capDto = new CapDto(static::$requiredAttributes);

        $this->assertEquals('day', $capDto->getPeriod());
    }

    public function testGetType(): void
    {
        $capDto = new CapDto(static::$requiredAttributes);

        $this->assertEquals('conversions', $capDto->getType());
    }

    public function testGetValue(): void
    {
        $capDto = new CapDto(static::$requiredAttributes);

        $this->assertEquals(100, $capDto->getValue());
    }

    public function testGetGoalType(): void
    {
        $capDto = new CapDto(static::$requiredAttributes);

        $this->assertEquals('exact', $capDto->getGoalType());
    }

    public function testGetGoals(): void
    {
        $capDto = new CapDto(static::$requiredAttributes);

        $this->assertEquals(['Install'], $capDto->getGoals());
    }

    public function testGetAffiliateType(): void
    {
        $capDto = new CapDto(static::$requiredAttributes + ['affiliate_type' => 'exact']);
        $this->assertEquals('exact', $capDto->getAffiliateType());

        $capDto = new CapDto(static::$requiredAttributes + ['affiliate_type' => null]);
        $this->assertNull($capDto->getAffiliateType());

        $capDto = new CapDto(static::$requiredAttributes);
        $this->assertNull($capDto->getAffiliateType());
    }

    public function testGetAffiliates(): void
    {
        $capDto = new CapDto(static::$requiredAttributes);

        $this->assertEquals([500, 600], $capDto->getAffiliates());
    }

    public function testGetCountry(): void
    {
        $capDto = new CapDto(static::$requiredAttributes + ['country' => ['US']]);
        $this->assertEquals(['US'], $capDto->getCountry());

        $capDto = new CapDto(static::$requiredAttributes + ['country' => null]);
        $this->assertEmpty($capDto->getCountry());

        $capDto = new CapDto(static::$requiredAttributes);
        $this->assertEmpty($capDto->getCountry());
    }

    public function testGetCountryType(): void
    {
        $capDto = new CapDto(static::$requiredAttributes + ['country_type' => 'all']);
        $this->assertEquals('all', $capDto->getCountryType());

        $capDto = new CapDto(static::$requiredAttributes + ['country_type' => null]);
        $this->assertNull($capDto->getCountryType());

        $capDto = new CapDto(static::$requiredAttributes);
        $this->assertNull($capDto->getCountryType());
    }
}
