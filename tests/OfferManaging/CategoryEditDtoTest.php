<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class CategoryEditDtoTest
 */
class CategoryEditDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '59440f427e28feff5c8b4567',
            'title' => 'test_category2',
        ];
    }

    public function testGetId(): void
    {
        $categoryEditDto = new CategoryEditDto(static::$requiredAttributes);

        $this->assertEquals('59440f427e28feff5c8b4567', $categoryEditDto->getId());
    }

    public function testGetTitle(): void
    {
        $categoryEditDto = new CategoryEditDto(static::$requiredAttributes);

        $this->assertEquals('test_category2', $categoryEditDto->getTitle());
    }
}
