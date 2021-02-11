<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
* Class CustomFieldsListDtoTest
*/
class CustomFieldsListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 1,
            'name' => 'Skype',
            'required' => false,
            'field_type' => 'text',
        ];
    }

    public function testGetId(): void
    {
        $customFieldsListDto = new CustomFieldsListDto(static::$requiredAttributes);

        $this->assertEquals(1, $customFieldsListDto->getId());
    }

    public function testGetName(): void
    {
        $customFieldsListDto = new CustomFieldsListDto(static::$requiredAttributes);

        $this->assertEquals('Skype', $customFieldsListDto->getName());
    }

    public function testIsRequired(): void
    {
        $customFieldsListDto = new CustomFieldsListDto(static::$requiredAttributes);

        $this->assertEquals(false, $customFieldsListDto->isRequired());
    }

    public function testGetFieldType(): void
    {
        $customFieldsListDto = new CustomFieldsListDto(static::$requiredAttributes);

        $this->assertEquals('text', $customFieldsListDto->getFieldType());
    }

    public function testGetFieldValues(): void
    {
        $customFieldsListDto = new CustomFieldsListDto(static::$requiredAttributes + ['field_values' => ['qui']]);
        $this->assertEquals(['qui'], $customFieldsListDto->getFieldValues());

        $customFieldsListDto = new CustomFieldsListDto(static::$requiredAttributes);
        $this->assertEmpty($customFieldsListDto->getFieldValues());
    }
}
