<?php

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class EditConversionDtoTest
 */
class EditConversionDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'ids' => [
                '59359e1d7e28feb7568b456a',
            ],
            'status' => 'confirmed',
        ];
    }

    public function testGetIds(): void
    {
        $editConversionDto = new EditConversionDto(static::$requiredAttributes);

        $this->assertEquals(['59359e1d7e28feb7568b456a'], $editConversionDto->getIds());
    }

    public function testGetStatus(): void
    {
        $editConversionDto = new EditConversionDto(static::$requiredAttributes);

        $this->assertEquals('confirmed', $editConversionDto->getStatus());
    }

    public function testGetCurrency(): void
    {
        $editConversionDto = new EditConversionDto(static::$requiredAttributes + ['currency' => 'USD']);
        $this->assertEquals('USD', $editConversionDto->getCurrency());

        $editConversionDto = new EditConversionDto(static::$requiredAttributes + ['currency' => null]);
        $this->assertNull($editConversionDto->getCurrency());

        $editConversionDto = new EditConversionDto(static::$requiredAttributes);
        $this->assertNull($editConversionDto->getCurrency());
    }

    public function testGetPayouts(): void
    {
        $editConversionDto = new EditConversionDto(static::$requiredAttributes + ['payouts' => 100]);
        $this->assertEquals(100, $editConversionDto->getPayouts());

        $editConversionDto = new EditConversionDto(static::$requiredAttributes + ['payouts' => null]);
        $this->assertNull($editConversionDto->getPayouts());

        $editConversionDto = new EditConversionDto(static::$requiredAttributes);
        $this->assertNull($editConversionDto->getPayouts());
    }

    public function testGetRevenue(): void
    {
        $editConversionDto = new EditConversionDto(static::$requiredAttributes + ['revenue' => 100]);
        $this->assertEquals(100, $editConversionDto->getRevenue());

        $editConversionDto = new EditConversionDto(static::$requiredAttributes + ['revenue' => null]);
        $this->assertNull($editConversionDto->getRevenue());

        $editConversionDto = new EditConversionDto(static::$requiredAttributes);
        $this->assertNull($editConversionDto->getRevenue());
    }
}

