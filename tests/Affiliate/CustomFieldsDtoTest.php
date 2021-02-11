<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class CustomFieldsDtoTest
*/
class CustomFieldsDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'name' => 'Skype',
            'value' => '1',
            'label' => '1',
            'id' => 1,
        ];
    }

    public function testGetName(): void
    {
        $customFieldsDto = new CustomFieldsDto(static::$requiredAttributes);

        $this->assertEquals('Skype', $customFieldsDto->getName());
    }

    public function testGetValue(): void
    {
        $customFieldsDto = new CustomFieldsDto(static::$requiredAttributes);
        $this->assertEquals('1', $customFieldsDto->getValue());

        $customFieldsDto = new CustomFieldsDto(array_merge(static::$requiredAttributes, ['value' => [1, 2, 3]]));
        $this->assertEquals([1, 2, 3], $customFieldsDto->getValue());
    }

    public function testGetLabel(): void
    {
        $customFieldsDto = new CustomFieldsDto(static::$requiredAttributes);
        $this->assertEquals('1', $customFieldsDto->getLabel());

        $customFieldsDto = new CustomFieldsDto(array_merge(static::$requiredAttributes, ['label' => [1 => 'a', 2 => 'b', 3 => 'c']]));
        $this->assertEquals([1 => 'a', 2 => 'b', 3 => 'c'], $customFieldsDto->getLabel());
    }

    public function testGetId(): void
    {
        $customFieldsDto = new CustomFieldsDto(static::$requiredAttributes);

        $this->assertEquals(1, $customFieldsDto->getId());
    }
}
