<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class CityDtoTest
 */
class CityDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'country_code' => 'KZ',
            'id' => 563497,
            'name' => 'Maksut',
            'region_code' => 30,
        ];
    }

    public function testGetCountryCode(): void
    {
        $cityDto = new CityDto(static::$requiredAttributes);

        $this->assertEquals('KZ', $cityDto->getCountryCode());
    }

    public function testGetId(): void
    {
        $cityDto = new CityDto(static::$requiredAttributes);

        $this->assertEquals(563497, $cityDto->getId());
    }

    public function testGetName(): void
    {
        $cityDto = new CityDto(static::$requiredAttributes);

        $this->assertEquals('Maksut', $cityDto->getName());
    }

    public function testGetRegionCode(): void
    {
        $cityDto = new CityDto(static::$requiredAttributes);

        $this->assertEquals(30, $cityDto->getRegionCode());
    }
}
