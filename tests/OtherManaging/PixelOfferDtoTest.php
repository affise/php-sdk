<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class PixelOfferDtoTest
 */
class PixelOfferDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 81,
            'offer_id' => '5f61df8c134ed051008b4569',
            'title' => 'MT Adult Dating Smartlink CPL WW',
            'preview_url' => 'quidem',
        ];
    }

    public function testGetId(): void
    {
        $pixelOfferDto = new PixelOfferDto(static::$requiredAttributes);

        $this->assertEquals(81, $pixelOfferDto->getId());
    }

    public function testGetOfferId(): void
    {
        $pixelOfferDto = new PixelOfferDto(static::$requiredAttributes);

        $this->assertEquals('5f61df8c134ed051008b4569', $pixelOfferDto->getOfferId());
    }

    public function testGetTitle(): void
    {
        $pixelOfferDto = new PixelOfferDto(static::$requiredAttributes);

        $this->assertEquals('MT Adult Dating Smartlink CPL WW', $pixelOfferDto->getTitle());
    }

    public function testGetPreviewUrl(): void
    {
        $pixelOfferDto = new PixelOfferDto(static::$requiredAttributes);

        $this->assertEquals('quidem', $pixelOfferDto->getPreviewUrl());
    }
}
