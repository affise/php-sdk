<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class ClicksDtoTest
 */
class ClicksDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '59359dcb7e28fee0558b4567',
            'ip' => 'ut',
            'ua' => 'molestias',
            'country' => 'US',
            'city' => 'New York',
            'device' => 'Other',
            'os' => 'non',
            'browser' => 'temporibus',
            'referrer' => '',
            'sub1' => '',
            'sub2' => '',
            'sub3' => '',
            'sub4' => '',
            'sub5' => '',
            'offer' => [
                'id' => 934,
                'offer_id' => '59313e097960ad2774b4f274',
                'title' => 'HD-smart [Web]',
                'url' => 'http://affise.com/1',
            ],
            'conversion_id' => '59359e1d7e28feb7568b456a',
            'ios_idfa' => '',
            'android_id' => '',
            'created_at' => '2017-06-06 03:07:07',
            'uniq' => 1,
            'cbid' => '59359dcb7e28fee0558b4567',
            'partner_id' => '610',
        ];
    }

    public function testGetId(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('59359dcb7e28fee0558b4567', $clicksDto->getId());
    }

    public function testGetIp(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('ut', $clicksDto->getIp());
    }

    public function testGetUa(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('molestias', $clicksDto->getUa());
    }

    public function testGetCountry(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('US', $clicksDto->getCountry());
    }

    public function testGetCity(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('New York', $clicksDto->getCity());
    }

    public function testGetDevice(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('Other', $clicksDto->getDevice());
    }

    public function testGetOs(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('non', $clicksDto->getOs());
    }

    public function testGetBrowser(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('temporibus', $clicksDto->getBrowser());
    }

    public function testGetReferrer(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getReferrer());
    }

    public function testGetSub1(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getSub1());
    }

    public function testGetSub2(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getSub2());
    }

    public function testGetSub3(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getSub3());
    }

    public function testGetSub4(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getSub4());
    }

    public function testGetSub5(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getSub5());
    }

    public function testGetOffer(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals(
            new OfferDto([
                'id' => 934,
                'offer_id' => '59313e097960ad2774b4f274',
                'title' => 'HD-smart [Web]',
                'url' => 'http://affise.com/1',
            ]),
            $clicksDto->getOffer()
        );
    }

    public function testGetConversionId(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('59359e1d7e28feb7568b456a', $clicksDto->getConversionId());
    }

    public function testGetIosIdfa(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getIosIdfa());
    }

    public function testGetAndroidId(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('', $clicksDto->getAndroidId());
    }

    public function testGetCreatedAt(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('2017-06-06 03:07:07', $clicksDto->getCreatedAt());
    }

    public function testGetUniq(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals(1, $clicksDto->getUniq());
    }

    public function testGetCbid(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('59359dcb7e28fee0558b4567', $clicksDto->getCbid());
    }

    public function testGetPartnerId(): void
    {
        $clicksDto = new ClicksDto(static::$requiredAttributes);

        $this->assertEquals('610', $clicksDto->getPartnerId());
    }
}
