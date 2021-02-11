<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class FieldDtoTest
 */
class FieldDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 1,
            'lang_label' => 'IBAN/Account Number',
            'required' => true,
        ];
    }

    public function testGetId(): void
    {
        $fieldDto = new FieldDto(static::$requiredAttributes);

        $this->assertEquals(1, $fieldDto->getId());
    }

    public function testGetLangLabel(): void
    {
        $fieldDto = new FieldDto(static::$requiredAttributes);

        $this->assertEquals('IBAN/Account Number', $fieldDto->getLangLabel());
    }

    public function testGetRequired(): void
    {
        $fieldDto = new FieldDto(static::$requiredAttributes);

        $this->assertEquals(true, $fieldDto->getRequired());
    }
}
