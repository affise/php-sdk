<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class CategoryAddDtoTest
 */
class CategoryAddDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '59440f427e28feff5c8b4567',
            'title' => 'test_category',
        ];
    }

    public function testGetId(): void
    {
        $categoryAddDto = new CategoryAddDto(static::$requiredAttributes);

        $this->assertEquals('59440f427e28feff5c8b4567', $categoryAddDto->getId());
    }

    public function testGetTitle(): void
    {
        $categoryAddDto = new CategoryAddDto(static::$requiredAttributes);

        $this->assertEquals('test_category', $categoryAddDto->getTitle());
    }
}
