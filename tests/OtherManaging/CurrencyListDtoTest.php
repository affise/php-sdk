<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class CurrencyListDtoTest
 */
class CurrencyListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            '_id' => 2,
            'code' => 'USD',
            'active' => true,
            'default' => true,
            'rate' => 1,
        ];
    }

    public function testGetCode(): void
    {
        $currencyListDto = new CurrencyListDto(static::$requiredAttributes);

        $this->assertEquals('USD', $currencyListDto->getCode());
    }

    public function testIsActive(): void
    {
        $currencyListDto = new CurrencyListDto(static::$requiredAttributes);

        $this->assertEquals(true, $currencyListDto->isActive());
    }

    public function testGetRate(): void
    {
        $currencyListDto = new CurrencyListDto(static::$requiredAttributes);
        $this->assertEquals(1, $currencyListDto->getRate());

        $currencyListDto = new CurrencyListDto(array_merge(static::$requiredAttributes, ['rate' => 1.75]));
        $this->assertEquals(1.75, $currencyListDto->getRate());
    }

    public function testIsDefault(): void
    {
        $currencyListDto = new CurrencyListDto(static::$requiredAttributes);
        $this->assertEquals(true, $currencyListDto->isDefault());
    }

    public function testGetMinPayment(): void
    {
        $currencyListDto = new CurrencyListDto(static::$requiredAttributes + ['min_payment' => 20]);
        $this->assertEquals(20, $currencyListDto->getMinPayment());

        $currencyListDto = new CurrencyListDto(static::$requiredAttributes);
        $this->assertNull($currencyListDto->getMinPayment());
    }

    public function testGetIsCrypto(): void
    {
        $currencyListDto = new CurrencyListDto(static::$requiredAttributes + ['is_crypto' => true]);
        $this->assertEquals(true, $currencyListDto->getIsCrypto());

        $currencyListDto = new CurrencyListDto(static::$requiredAttributes);
        $this->assertNull($currencyListDto->getIsCrypto());
    }

    public function testGetId(): void
    {
        $currencyListDto = new CurrencyListDto(static::$requiredAttributes);

        $this->assertEquals(2, $currencyListDto->getId());
    }
}

