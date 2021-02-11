<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class OfferWithExternalDtoTest
 */
class OfferWithExternalDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 7,
            'title' => 'Test Offer',
            'offer_id' => '5b59b752f44d940011105103',
            'url' => 'http://affise.com',
        ];
    }

    public function testGetId(): void
    {
        $offerDto = new OfferWithExternalDto(static::$requiredAttributes);

        $this->assertEquals(7, $offerDto->getId());
    }

    public function testGetTitle(): void
    {
        $offerDto = new OfferWithExternalDto(static::$requiredAttributes);

        $this->assertEquals('Test Offer', $offerDto->getTitle());
    }

    public function testGetOfferId(): void
    {
        $offerDto = new OfferWithExternalDto(static::$requiredAttributes);

        $this->assertEquals('5b59b752f44d940011105103', $offerDto->getOfferId());
    }

    public function testGetUrl(): void
    {
        $offerDto = new OfferWithExternalDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $offerDto->getUrl());
    }

    public function testGetExternalOfferId(): void
    {
        $offerDto = new OfferWithExternalDto(static::$requiredAttributes + ['external_offer_id' => '9080']);
        $this->assertEquals('9080', $offerDto->getExternalOfferId());

        $offerDto = new OfferWithExternalDto(static::$requiredAttributes + ['external_offer_id' => null]);
        $this->assertNull($offerDto->getExternalOfferId());

        $offerDto = new OfferWithExternalDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getExternalOfferId());
    }
}

