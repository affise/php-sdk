<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

use PHPUnit\Framework\TestCase;

/**
 * Class ISPListDtoTest
 */
class ISPListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'country' => 'KZ',
            'name' => 'Rebekah Kovacek',
        ];
    }

    public function testGetCountry(): void
    {
        $iSPListDto = new ISPListDto(static::$requiredAttributes);

        $this->assertEquals('KZ', $iSPListDto->getCountry());
    }

    public function testGetName(): void
    {
        $iSPListDto = new ISPListDto(static::$requiredAttributes);

        $this->assertEquals('Rebekah Kovacek', $iSPListDto->getName());
    }
}
