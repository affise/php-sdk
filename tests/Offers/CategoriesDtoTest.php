<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class CategoriesDtoTest
 */
class CategoriesDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5368a3973b7d9b4d5d59f1ca',
            'title' => 'Prof.',
        ];
    }

    public function testGetId(): void
    {
        $categoriesDto = new CategoriesDto(static::$requiredAttributes);

        $this->assertEquals('5368a3973b7d9b4d5d59f1ca', $categoriesDto->getId());
    }

    public function testGetTitle(): void
    {
        $categoriesDto = new CategoriesDto(static::$requiredAttributes);

        $this->assertEquals('Prof.', $categoriesDto->getTitle());
    }
}
