<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class PaymentSystemsDtoTest
*/
class PaymentSystemsDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 10895,
            'active' => 0,
            'system' => 'Webmoney WMR',
            'fields' => ['test'],
            'currency' => 1,
            'system_id' => 1,
        ];
    }

    public function testGetId(): void
    {
        $paymentSystemsDto = new PaymentSystemsDto(static::$requiredAttributes);

        $this->assertEquals(10895, $paymentSystemsDto->getId());
    }

    public function testGetActive(): void
    {
        $paymentSystemsDto = new PaymentSystemsDto(static::$requiredAttributes);

        $this->assertEquals(0, $paymentSystemsDto->getActive());
    }

    public function testGetSystem(): void
    {
        $paymentSystemsDto = new PaymentSystemsDto(static::$requiredAttributes);

        $this->assertEquals('Webmoney WMR', $paymentSystemsDto->getSystem());
    }

    public function testGetFields(): void
    {
        $paymentSystemsDto = new PaymentSystemsDto(static::$requiredAttributes);

        $this->assertEquals(['test'], $paymentSystemsDto->getFields());
    }

    public function testGetCurrency(): void
    {
        $paymentSystemsDto = new PaymentSystemsDto(static::$requiredAttributes);

        $this->assertEquals(1, $paymentSystemsDto->getCurrency());
    }

    public function testGetSystemId(): void
    {
        $paymentSystemsDto = new PaymentSystemsDto(static::$requiredAttributes);

        $this->assertEquals(1, $paymentSystemsDto->getSystemId());
    }
}
