<?php

declare(strict_types=1);

namespace Affise\Sdk\AdvertiserBilling;

use PHPUnit\Framework\TestCase;

/**
 * Class DetailDtoTest
 */
class DetailDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'offer_id' => 1,
            'payout_type' => 'RPA',
            'actions' => 100,
            'amount' => 100,
        ];
    }

    public function testGetOfferId(): void
    {
        $detailDto = new DetailDto(static::$requiredAttributes);

        $this->assertEquals(1, $detailDto->getOfferId());
    }

    public function testGetPayoutType(): void
    {
        $detailDto = new DetailDto(static::$requiredAttributes);

        $this->assertEquals('RPA', $detailDto->getPayoutType());
    }

    public function testGetActions(): void
    {
        $detailDto = new DetailDto(static::$requiredAttributes);

        $this->assertEquals(100, $detailDto->getActions());
    }

    public function testGetAmount(): void
    {
        $detailDto = new DetailDto(static::$requiredAttributes);

        $this->assertEquals(100, $detailDto->getAmount());
    }

    public function testGetComment(): void
    {
        $detailDto = new DetailDto(static::$requiredAttributes + ['comment' => 'eos']);
        $this->assertEquals('eos', $detailDto->getComment());

        $detailDto = new DetailDto(static::$requiredAttributes + ['comment' => null]);
        $this->assertNull($detailDto->getComment());

        $detailDto = new DetailDto(static::$requiredAttributes);
        $this->assertNull($detailDto->getComment());
    }
}
