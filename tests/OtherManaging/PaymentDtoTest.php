<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class PaymentDtoTest
 */
class PaymentDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'countries' => [],
            'cities' => [],
            'country_exclude' => false,
            'title' => '',
            'goal' => '1',
            'revenue' => 75.25,
            'currency' => 'USD',
            'type' => 'percent',
            'devices' => [],
            'os' => [],
        ];
    }

    public function testGetCountries(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $paymentDto->getCountries());
    }

    public function testGetCities(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $paymentDto->getCities());
    }

    public function testGetCountryExclude(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals(false, $paymentDto->getCountryExclude());
    }

    public function testGetTitle(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('', $paymentDto->getTitle());
    }

    public function testGetGoal(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('1', $paymentDto->getGoal());
    }

    public function testGetRevenue(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals(75.25, $paymentDto->getRevenue());
    }

    public function testGetCurrency(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('USD', $paymentDto->getCurrency());
    }

    public function testGetType(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('percent', $paymentDto->getType());
    }

    public function testGetDevices(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $paymentDto->getDevices());
    }

    public function testGetOs(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $paymentDto->getOs());
    }
}
