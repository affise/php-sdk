<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class FullCategoryDtoTest
 */
class FullCategoryDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5f1845f9134ed050008b4568',
            'title' => 'Dating Adult',
        ];
    }

    public function testGetId(): void
    {
        $fullCategoryDto = new FullCategoryDto(static::$requiredAttributes);

        $this->assertEquals('5f1845f9134ed050008b4568', $fullCategoryDto->getId());
    }

    public function testGetTitle(): void
    {
        $fullCategoryDto = new FullCategoryDto(static::$requiredAttributes);

        $this->assertEquals('Dating Adult', $fullCategoryDto->getTitle());
    }
}
