<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class PartnerPaymentDtoTest
 */
class PartnerPaymentDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'countries' => [],
            'cities' => [],
            'devices' => [],
            'os' => [],
            'goal' => '2',
            'total' => 1600.05,
            'revenue' => 900.85,
            'currency' => 'usd',
            'title' => 'Dr.',
            'type' => 'fixed',
            'country_exclude' => false,
            'with_regions' => false,
            'partners' => [610],
        ];
    }

    public function testGetCountries(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $partnerPaymentDto->getCountries());
    }

    public function testGetCities(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $partnerPaymentDto->getCities());
    }

    public function testGetDevices(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $partnerPaymentDto->getDevices());
    }

    public function testGetOs(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals([], $partnerPaymentDto->getOs());
    }

    public function testGetGoal(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals('2', $partnerPaymentDto->getGoal());
    }

    public function testGetTotal(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals(1600.05, $partnerPaymentDto->getTotal());
    }

    public function testGetRevenue(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals(900.85, $partnerPaymentDto->getRevenue());
    }

    public function testGetCurrency(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals('usd', $partnerPaymentDto->getCurrency());
    }

    public function testGetTitle(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals('Dr.', $partnerPaymentDto->getTitle());
    }

    public function testGetType(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals('fixed', $partnerPaymentDto->getType());
    }

    public function testIsCountryExclude(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals(false, $partnerPaymentDto->isCountryExclude());
    }

    public function testIsWithRegions(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals(false, $partnerPaymentDto->isWithRegions());
    }

    public function testGetPartners(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);

        $this->assertEquals([610], $partnerPaymentDto->getPartners());
    }

    public function testGetUrl(): void
    {
        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes + ['url' => 'http://affise.com']);
        $this->assertEquals('http://affise.com', $partnerPaymentDto->getUrl());

        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes + ['url' => null]);
        $this->assertNull($partnerPaymentDto->getUrl());

        $partnerPaymentDto = new PartnerPaymentDto(static::$requiredAttributes);
        $this->assertNull($partnerPaymentDto->getUrl());
    }
}
