<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class TimeToActionDtoTest
 */
class TimeToActionDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'affiliate_id' => 70,
            'clicks' => 90,
            'total_conversions' => 4,
            'tta_30' => 3,
            'tta_600' => 1,
            'tta_inf' => 0,
        ];
    }

    public function testGetAffiliateId(): void
    {
        $timeToActionDto = new TimeToActionDto(static::$requiredAttributes);

        $this->assertEquals(70, $timeToActionDto->getAffiliateId());
    }

    public function testGetClicks(): void
    {
        $timeToActionDto = new TimeToActionDto(static::$requiredAttributes);

        $this->assertEquals(90, $timeToActionDto->getClicks());
    }

    public function testGetTotalConversions(): void
    {
        $timeToActionDto = new TimeToActionDto(static::$requiredAttributes);

        $this->assertEquals(4, $timeToActionDto->getTotalConversions());
    }

    public function testGetTta30(): void
    {
        $timeToActionDto = new TimeToActionDto(static::$requiredAttributes);

        $this->assertEquals(3, $timeToActionDto->getTta30());
    }

    public function testGetTta600(): void
    {
        $timeToActionDto = new TimeToActionDto(static::$requiredAttributes);

        $this->assertEquals(1, $timeToActionDto->getTta600());
    }

    public function testGetTtaInf(): void
    {
        $timeToActionDto = new TimeToActionDto(static::$requiredAttributes);

        $this->assertEquals(0, $timeToActionDto->getTtaInf());
    }
}
