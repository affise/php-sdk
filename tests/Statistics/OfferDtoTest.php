<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class OfferDtoTest
 */
class OfferDtoTest extends TestCase
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
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(7, $offerDto->getId());
    }

    public function testGetTitle(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('Test Offer', $offerDto->getTitle());
    }

    public function testGetOfferId(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('5b59b752f44d940011105103', $offerDto->getOfferId());
    }

    public function testGetUrl(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $offerDto->getUrl());
    }
}
