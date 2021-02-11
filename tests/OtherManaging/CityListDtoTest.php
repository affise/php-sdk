<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class CityListDtoTest
 */
class CityListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'country_code' => 'DE',
            'id' => 79729,
            'name' => 'Thallichtenberg',
            'region_code' => 100,
            'region' => 'Rheinland-Pfalz',
        ];
    }

    public function testGetCountryCode(): void
    {
        $cityListDto = new CityListDto(static::$requiredAttributes);

        $this->assertEquals('DE', $cityListDto->getCountryCode());
    }

    public function testGetId(): void
    {
        $cityListDto = new CityListDto(static::$requiredAttributes);

        $this->assertEquals(79729, $cityListDto->getId());
    }

    public function testGetName(): void
    {
        $cityListDto = new CityListDto(static::$requiredAttributes);

        $this->assertEquals('Thallichtenberg', $cityListDto->getName());
    }

    public function testGetRegionCode(): void
    {
        $cityListDto = new CityListDto(static::$requiredAttributes);

        $this->assertEquals(100, $cityListDto->getRegionCode());
    }

    public function testGetRegion(): void
    {
        $cityListDto = new CityListDto(static::$requiredAttributes);

        $this->assertEquals('Rheinland-Pfalz', $cityListDto->getRegion());
    }
}
