<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class PixelDtoTest
 */
class PixelDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 1,
            'name' => 'Dion Murazik',
            'code' => '<script>alert(\'123\');</script>',
            'code_type' => 'javascript',
            'offer_id' => 906,
            'offer' => [
                'id' => 11,
                'offer_id' => '5f05f2f5134ed05c008b4568',
                'title' => 'Varmogvillig.com CPL DOI NO WEB\\TAB\\MOB',
                'preview_url' => 'https://www.varmogvillig.com/landing2',
            ],
            'pid' => 610,
            'is_active' => 0,
            'moderation_status' => 0,
            'created_at' => '2017-06-19 22:49:07',
            'updated_at' => '2017-06-19 22:49:07',
        ];
    }

    public function testGetId(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals(1, $pixelListDto->getId());
    }

    public function testGetName(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals('Dion Murazik', $pixelListDto->getName());
    }

    public function testGetCode(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals('<script>alert(\'123\');</script>', $pixelListDto->getCode());
    }

    public function testGetCodeType(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals('javascript', $pixelListDto->getCodeType());
    }

    public function testGetOfferId(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals(906, $pixelListDto->getOfferId());
    }

    public function testGetOffer(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals(
            new PixelOfferDto(
                [
                    'id' => 11,
                    'offer_id' => '5f05f2f5134ed05c008b4568',
                    'title' => 'Varmogvillig.com CPL DOI NO WEB\\TAB\\MOB',
                    'preview_url' => 'https://www.varmogvillig.com/landing2',
                ]
            ),
            $pixelListDto->getOffer()
        );
    }

    public function testGetPid(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals(610, $pixelListDto->getPid());
    }

    public function testGetIsActive(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals(false, $pixelListDto->getIsActive());
    }

    public function testGetModerationStatus(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals(false, $pixelListDto->getModerationStatus());
    }

    public function testGetCreatedAt(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals('2017-06-19 22:49:07', $pixelListDto->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        $pixelListDto = new PixelDto(static::$requiredAttributes);

        $this->assertEquals('2017-06-19 22:49:07', $pixelListDto->getUpdatedAt());
    }
}
