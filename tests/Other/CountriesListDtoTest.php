<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

use PHPUnit\Framework\TestCase;

/**
 * Class CountriesListDtoTest
 */
class CountriesListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'code' => 'KP',
            'name' => 'North Korea',
        ];
    }

    public function testGetCode(): void
    {
        $countriesListDto = new CountriesListDto(static::$requiredAttributes);

        $this->assertEquals('KP', $countriesListDto->getCode());
    }

    public function testGetName(): void
    {
        $countriesListDto = new CountriesListDto(static::$requiredAttributes);

        $this->assertEquals('North Korea', $countriesListDto->getName());
    }
}
