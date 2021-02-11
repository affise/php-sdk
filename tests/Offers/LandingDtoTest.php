<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class LandingDtoTest
 */
class LandingDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 1,
            'title' => 'Prof.',
            'url' => 'http://affise.com',
            'url_preview' => 'eos',
            'type' => 'landing',
        ];
    }

    public function testGetId(): void
    {
        $landingDto = new LandingDto(static::$requiredAttributes);

        $this->assertEquals(1, $landingDto->getId());
    }

    public function testGetTitle(): void
    {
        $landingDto = new LandingDto(static::$requiredAttributes);

        $this->assertEquals('Prof.', $landingDto->getTitle());
    }

    public function testGetUrl(): void
    {
        $landingDto = new LandingDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $landingDto->getUrl());
    }

    public function testGetUrlPreview(): void
    {
        $landingDto = new LandingDto(static::$requiredAttributes);

        $this->assertEquals('eos', $landingDto->getUrlPreview());
    }

    public function testGetType(): void
    {
        $landingDto = new LandingDto(static::$requiredAttributes);

        $this->assertEquals('landing', $landingDto->getType());
    }
}
