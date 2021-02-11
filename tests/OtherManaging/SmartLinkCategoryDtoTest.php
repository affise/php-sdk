<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class SmartLinkCategoryDtoTest
 */
class SmartLinkCategoryDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            '_id' => '595e3b547e28fede7b8b456c',
            'name' => 'test1',
            'domain' => 'aut',
            'created_at' => '2017-07-06 13:29:56',
        ];
    }

    public function testGetId(): void
    {
        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes);

        $this->assertEquals('595e3b547e28fede7b8b456c', $smartLinkCategoriesDto->getId());
    }

    public function testGetName(): void
    {
        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes);

        $this->assertEquals('test1', $smartLinkCategoriesDto->getName());
    }

    public function testGetDomain(): void
    {
        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes);

        $this->assertEquals('aut', $smartLinkCategoriesDto->getDomain());
    }

    public function testGetCreatedAt(): void
    {
        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes);

        $this->assertEquals('2017-07-06 13:29:56', $smartLinkCategoriesDto->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes + ['updated_at' => '2017-07-06 13:29:56']);
        $this->assertEquals('2017-07-06 13:29:56', $smartLinkCategoriesDto->getUpdatedAt());

        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes + ['updated_at' => null]);
        $this->assertNull($smartLinkCategoriesDto->getUpdatedAt());

        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes);
        $this->assertNull($smartLinkCategoriesDto->getUpdatedAt());
    }

    public function testGetDescription(): void
    {
        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes + ['description' => 'perferendis']);
        $this->assertEquals('perferendis', $smartLinkCategoriesDto->getDescription());

        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes + ['description' => null]);
        $this->assertNull($smartLinkCategoriesDto->getDescription());

        $smartLinkCategoriesDto = new SmartLinkCategoryDto(static::$requiredAttributes);
        $this->assertNull($smartLinkCategoriesDto->getDescription());
    }
}
