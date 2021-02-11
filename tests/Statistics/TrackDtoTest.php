<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class TrackDtoTest
 */
class TrackDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5f4ef574125d9900010927fc',
            'created_at' => '2020-09-02 04:29:24',
            'ip' => 'illum',
            'ua' => 'vitae',
            'sub1' => '',
            'sub2' => '',
            'sub3' => '5f4ef57496c6540001af032b',
            'sub4' => '',
            'sub5' => '',
            'sub6' => '',
            'sub7' => '',
            'sub8' => '',
            'offer' => [
                'id' => 57,
                'offer_id' => '5f3e4c2e134ed084008b4567',
                'title' => 'Adult Dates CPL SOI US UK CA AU NZ FI FR NO ZA CH FR WEB/TAB/MOB',
                'url' => 'http://affise.com',
            ],
            'partner_id' => 2,
            'browser' => 'Mobile Safari',
            'browser_version' => 'commodi',
            'browser_fullname' => 'sapiente',
            'os' => 'iOS',
            'os_version' => 'minima',
            'os_fullname' => 'sunt',
            'device' => 'Apple',
            'device_fullname' => '',
            'device_model' => 'iPhone|iPhone 3G|iPhone 3GS|iPhone 4|iPhone 4S|iPhone 5|iPhone 5S|iPhone 6|iPhone 6 Plus|iPhone 6s|iPhone 6s Plus|iPhone SE|iPhone 7|iPhone 7 Plus|iPhone 8|iPhone 8 Plus|iPhone X|iPhone XR|iPhone XS|iPhone XS Max|iPhone 11 Pro|iPhone 11|iPhone 11 Pro Max',
            'device_type' => 'mobile',
            'city' => 'San Antonio',
            'country' => 'US',
            'city_id' => 76,
            'connection_type' => 'wi-fi',
            'isp_code' => '?',
            'referrer' => '',
            'smart_id' => '',
            'landing' => [
                'id' => '',
            ],
            'prelanding' => [
                'id' => '',
            ],
            'ref_id' => '',
            'os_id' => '',
            'user_id' => '',
            'ext1' => '',
            'ext2' => '',
            'ext3' => '',
            'partner' => [
                'id' => 2,
                'login' => '',
                'email' => 'dino54@example.com',
                'name' => 'test',
                'title' => 'test',
                'manager' => [
                    'id' => '5f72fc82afd0ba5d88c4bd00',
                    'title' => 'Curtis Ross',
                    'first_name' => '',
                    'last_name' => '',
                ],
                'manager_id' => '5f9008bfafd0ba5d88c4dee8',
            ],
        ];
    }

    public function testGetId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('5f4ef574125d9900010927fc', $trackDto->getId());
    }

    public function testGetCreatedAt(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('2020-09-02 04:29:24', $trackDto->getCreatedAt());
    }

    public function testGetIp(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('illum', $trackDto->getIp());
    }

    public function testGetUa(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('vitae', $trackDto->getUa());
    }

    public function testGetSub1(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSub1());
    }

    public function testGetSub2(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSub2());
    }

    public function testGetSub3(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('5f4ef57496c6540001af032b', $trackDto->getSub3());
    }

    public function testGetSub4(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSub4());
    }

    public function testGetSub5(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSub5());
    }

    public function testGetSub6(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSub6());
    }

    public function testGetSub7(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSub7());
    }

    public function testGetSub8(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSub8());
    }

    public function testGetOffer(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals(
            new OfferDto([
                'id' => 57,
                'offer_id' => '5f3e4c2e134ed084008b4567',
                'title' => 'Adult Dates CPL SOI US UK CA AU NZ FI FR NO ZA CH FR WEB/TAB/MOB',
                'url' => 'http://affise.com',
            ]),
            $trackDto->getOffer()
        );
    }

    public function testGetPartnerId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals(2, $trackDto->getPartnerId());
    }

    public function testGetBrowser(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('Mobile Safari', $trackDto->getBrowser());
    }

    public function testGetBrowserVersion(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('commodi', $trackDto->getBrowserVersion());
    }

    public function testGetBrowserFullname(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('sapiente', $trackDto->getBrowserFullname());
    }

    public function testGetOs(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('iOS', $trackDto->getOs());
    }

    public function testGetOsVersion(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('minima', $trackDto->getOsVersion());
    }

    public function testGetOsFullname(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('sunt', $trackDto->getOsFullname());
    }

    public function testGetDevice(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('Apple', $trackDto->getDevice());
    }

    public function testGetDeviceFullname(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getDeviceFullname());
    }

    public function testGetDeviceModel(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals(
            'iPhone|iPhone 3G|iPhone 3GS|iPhone 4|iPhone 4S|iPhone 5|iPhone 5S|iPhone 6|iPhone 6 Plus|iPhone 6s|iPhone 6s Plus|iPhone SE|iPhone 7|iPhone 7 Plus|iPhone 8|iPhone 8 Plus|iPhone X|iPhone XR|iPhone XS|iPhone XS Max|iPhone 11 Pro|iPhone 11|iPhone 11 Pro Max',
            $trackDto->getDeviceModel()
        );
    }

    public function testGetDeviceType(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('mobile', $trackDto->getDeviceType());
    }

    public function testGetCity(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('San Antonio', $trackDto->getCity());
    }

    public function testGetCountry(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('US', $trackDto->getCountry());
    }

    public function testGetCityId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals(76, $trackDto->getCityId());
    }

    public function testGetConnectionType(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('wi-fi', $trackDto->getConnectionType());
    }

    public function testGetIspCode(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('?', $trackDto->getIspCode());
    }

    public function testGetReferrer(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getReferrer());
    }

    public function testGetSmartId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getSmartId());
    }

    public function testGetLanding(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals(
            new LandingDto([
                'id' => '',
            ]),
            $trackDto->getLanding()
        );
    }

    public function testGetPrelanding(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals(
            new LandingDto([
                'id' => '',
            ]),
            $trackDto->getPrelanding()
        );
    }

    public function testGetRefId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getRefId());
    }

    public function testGetOsId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getOsId());
    }

    public function testGetUserId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getUserId());
    }

    public function testGetExt1(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getExt1());
    }

    public function testGetExt2(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getExt2());
    }

    public function testGetExt3(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals('', $trackDto->getExt3());
    }

    public function testGetPartner(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes);

        $this->assertEquals(
            new PostbackPartnerDto(
                [
                    'id' => 2,
                    'login' => '',
                    'email' => 'dino54@example.com',
                    'name' => 'test',
                    'title' => 'test',
                    'manager' => [
                        'id' => '5f72fc82afd0ba5d88c4bd00',
                        'title' => 'Curtis Ross',
                        'first_name' => '',
                        'last_name' => '',
                    ],
                    'manager_id' => '5f9008bfafd0ba5d88c4dee8',
                ]
            ),
            $trackDto->getPartner()
        );
    }

    public function testGetDistrict(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['district' => 'fuga']);
        $this->assertEquals('fuga', $trackDto->getDistrict());

        $trackDto = new TrackDto(static::$requiredAttributes + ['district' => null]);
        $this->assertNull($trackDto->getDistrict());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getDistrict());
    }

    public function testGetLandingId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['landing_id' => 'veritatis']);
        $this->assertEquals('veritatis', $trackDto->getLandingId());

        $trackDto = new TrackDto(static::$requiredAttributes + ['landing_id' => null]);
        $this->assertNull($trackDto->getLandingId());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getLandingId());
    }

    public function testGetPrelandingId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['prelanding_id' => 'temporibus']);
        $this->assertEquals('temporibus', $trackDto->getPrelandingId());

        $trackDto = new TrackDto(static::$requiredAttributes + ['prelanding_id' => null]);
        $this->assertNull($trackDto->getPrelandingId());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getPrelandingId());
    }

    public function testGetCountryName(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['country_name' => 'dignissimos']);
        $this->assertEquals('dignissimos', $trackDto->getCountryName());

        $trackDto = new TrackDto(static::$requiredAttributes + ['country_name' => null]);
        $this->assertNull($trackDto->getCountryName());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getCountryName());
    }

    public function testGetClickId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['click_id' => 'vitae']);
        $this->assertEquals('vitae', $trackDto->getClickId());

        $trackDto = new TrackDto(static::$requiredAttributes + ['click_id' => null]);
        $this->assertNull($trackDto->getClickId());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getClickId());
    }

    public function testGetConversionId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['conversion_id' => 'consequatur']);
        $this->assertEquals('consequatur', $trackDto->getConversionId());

        $trackDto = new TrackDto(static::$requiredAttributes + ['conversion_id' => null]);
        $this->assertNull($trackDto->getConversionId());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getConversionId());
    }

    public function testGetHasConversions(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['has_conversions' => true]);
        $this->assertEquals(true, $trackDto->getHasConversions());

        $trackDto = new TrackDto(static::$requiredAttributes + ['has_conversions' => null]);
        $this->assertNull($trackDto->getHasConversions());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getHasConversions());
    }

    public function testGetCbid(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['cbid' => 'asperiores']);
        $this->assertEquals('asperiores', $trackDto->getCbid());

        $trackDto = new TrackDto(static::$requiredAttributes + ['cbid' => null]);
        $this->assertNull($trackDto->getCbid());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getCbid());
    }

    public function testGetIdfa(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['idfa' => 'mollitia']);
        $this->assertEquals('mollitia', $trackDto->getIdfa());

        $trackDto = new TrackDto(static::$requiredAttributes + ['idfa' => null]);
        $this->assertNull($trackDto->getIdfa());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getIdfa());
    }

    public function testGetIsp(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['isp' => 1]);
        $this->assertEquals(1, $trackDto->getIsp());

        $trackDto = new TrackDto(static::$requiredAttributes + ['isp' => null]);
        $this->assertNull($trackDto->getIsp());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getIsp());
    }

    public function testGetUniq(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['uniq' => true]);
        $this->assertEquals(true, $trackDto->getUniq());

        $trackDto = new TrackDto(static::$requiredAttributes + ['uniq' => null]);
        $this->assertNull($trackDto->getUniq());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getUniq());
    }

    public function testGetSupplierManagerId(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['supplier_manager_id' => 'similique']);
        $this->assertEquals('similique', $trackDto->getSupplierManagerId());

        $trackDto = new TrackDto(static::$requiredAttributes + ['supplier_manager_id' => null]);
        $this->assertNull($trackDto->getSupplierManagerId());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getSupplierManagerId());
    }

    public function testGetUnid(): void
    {
        $trackDto = new TrackDto(static::$requiredAttributes + ['unid' => 'quidem']);
        $this->assertEquals('quidem', $trackDto->getUnid());

        $trackDto = new TrackDto(static::$requiredAttributes + ['unid' => null]);
        $this->assertNull($trackDto->getUnid());

        $trackDto = new TrackDto(static::$requiredAttributes);
        $this->assertNull($trackDto->getUnid());
    }
}
