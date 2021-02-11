<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

use PHPUnit\Framework\TestCase;

/**
 * Class RegionsListDtoTest
 */
class RegionsListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 2,
            'name' => 'Alaska',
            'country_code' => 'US',
        ];
    }

    public function testGetId(): void
    {
        $regionsListDto = new RegionsListDto(static::$requiredAttributes);

        $this->assertEquals(2, $regionsListDto->getId());
    }

    public function testGetName(): void
    {
        $regionsListDto = new RegionsListDto(static::$requiredAttributes);

        $this->assertEquals('Alaska', $regionsListDto->getName());
    }

    public function testGetCountryCode(): void
    {
        $regionsListDto = new RegionsListDto(static::$requiredAttributes);

        $this->assertEquals('US', $regionsListDto->getCountryCode());
    }
}
