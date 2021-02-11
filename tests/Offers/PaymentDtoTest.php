<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

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
            'countries' => ['kz'],
            'cities' => [
                [
                    'country_code' => 'KZ',
                    'id' => 563497,
                    'name' => 'Maksut',
                    'region_code' => 30,

                ],
            ],
            'devices' => [],
            'os' => [],
            'goal' => '1',
            'revenue' => 500.75,
            'currency' => 'usd',
            'title' => 'goal1',
            'type' => 'fixed',
            'country_exclude' => false,
        ];
    }

    public function testGetCountries(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals(['kz'], $paymentDto->getCountries());
    }

    public function testGetCities(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CityDto(
                    [
                        'country_code' => 'KZ',
                        'id' => 563497,
                        'name' => 'Maksut',
                        'region_code' => 30,
                    ]
                ),
            ],
            $paymentDto->getCities()
        );
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

    public function testGetGoal(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('1', $paymentDto->getGoal());
    }

    public function testGetRevenue(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals(500.75, $paymentDto->getRevenue());
    }

    public function testGetCurrency(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('usd', $paymentDto->getCurrency());
    }

    public function testGetTitle(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('goal1', $paymentDto->getTitle());
    }

    public function testGetType(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals('fixed', $paymentDto->getType());
    }

    public function testIsCountryExclude(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes);

        $this->assertEquals(false, $paymentDto->isCountryExclude());
    }

    public function testGetTotal(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['total' => 1000.25]);
        $this->assertEquals(1000.25, $paymentDto->getTotal());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['total' => null]);
        $this->assertNull($paymentDto->getTotal());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getTotal());
    }

    public function testIsWithRegions(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['with_regions' => false]);
        $this->assertEquals(false, $paymentDto->isWithRegions());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['with_regions' => null]);
        $this->assertNull($paymentDto->isWithRegions());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->isWithRegions());
    }

    public function testGetUrl(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['url' => 'http://affise.com']);
        $this->assertEquals('http://affise.com', $paymentDto->getUrl());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['url' => null]);
        $this->assertNull($paymentDto->getUrl());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getUrl());
    }

    public function testGetSub1(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub1' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub1());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub1' => null]);
        $this->assertNull($paymentDto->getSub1());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub1());
    }

    public function testGetSub2(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub2' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub2());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub2' => null]);
        $this->assertNull($paymentDto->getSub2());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub2());
    }

    public function testGetSub3(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub3' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub3());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub3' => null]);
        $this->assertNull($paymentDto->getSub3());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub3());
    }

    public function testGetSub4(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub4' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub4());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub4' => null]);
        $this->assertNull($paymentDto->getSub4());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub4());
    }

    public function testGetSub5(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub5' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub5());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub5' => null]);
        $this->assertNull($paymentDto->getSub5());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub5());
    }

    public function testGetSub6(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub6' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub6());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub6' => null]);
        $this->assertNull($paymentDto->getSub6());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub6());
    }

    public function testGetSub7(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub7' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub7());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub7' => null]);
        $this->assertNull($paymentDto->getSub7());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub7());
    }

    public function testGetSub8(): void
    {
        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub8' => 'test']);
        $this->assertEquals('test', $paymentDto->getSub8());

        $paymentDto = new PaymentDto(static::$requiredAttributes + ['sub8' => null]);
        $this->assertNull($paymentDto->getSub8());

        $paymentDto = new PaymentDto(static::$requiredAttributes);
        $this->assertNull($paymentDto->getSub8());
    }
}
