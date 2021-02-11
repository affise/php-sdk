<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class RetentionRateDtoTest
 */
class RetentionRateDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'affiliate_id' => 1,
            'date' => '2018-10-18',
            'rr_install' => 66.66,
            'rr_other1' => 100,
            'rr_other2' => 33.33,
            'install_count' => 3,
        ];
    }

    public function testGetAffiliateId(): void
    {
        $retentionRateDto = new RetentionRateDto(static::$requiredAttributes);

        $this->assertEquals(1, $retentionRateDto->getAffiliateId());
    }

    public function testGetDate(): void
    {
        $retentionRateDto = new RetentionRateDto(static::$requiredAttributes);

        $this->assertEquals('2018-10-18', $retentionRateDto->getDate());
    }

    public function testGetRrInstall(): void
    {
        $retentionRateDto = new RetentionRateDto(static::$requiredAttributes);

        $this->assertEquals(66.66, $retentionRateDto->getRrInstall());
    }

    public function testGetRrOther1(): void
    {
        $retentionRateDto = new RetentionRateDto(static::$requiredAttributes);

        $this->assertEquals(100, $retentionRateDto->getRrOther1());
    }

    public function testGetRrOther2(): void
    {
        $retentionRateDto = new RetentionRateDto(static::$requiredAttributes);

        $this->assertEquals(33.33, $retentionRateDto->getRrOther2());
    }

    public function testGetInstallCount(): void
    {
        $retentionRateDto = new RetentionRateDto(static::$requiredAttributes);

        $this->assertEquals(3, $retentionRateDto->getInstallCount());
    }
}
