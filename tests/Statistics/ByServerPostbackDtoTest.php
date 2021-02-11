<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class ByServerPostbackDtoTest
 */
class ByServerPostbackDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            '_id' => ['$id' => '5fcdfafd96f0b67522427bf2'],
            '_get' => ['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8'],
            'get' => '{"clickid":"b46e3cc99b5a49b782b85cc6841855e8"}',
            'post' => '[]',
            'server' => 'quia',
            'supplier' => [
                'id' => '5f059cf72bdea5690c593e53',
                'title' => 'WC',
            ],
            'date' => ['sec' => 1607334653, 'usec' => 3207165000],
            'response' => '{"status": 2,"message": "Broken clickid"}',
            'track' => [
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
                'device_model' => 'iPhone 7 Plus|iPhone 8|iPhone 8 Plus|iPhone X',
                'device_type' => 'mobile',
                'city' => 'San Antonio',
                'country' => 'US',
                'city_id' => 76,
                'district' => 'fuga',
                'connection_type' => 'wi-fi',
                'isp_code' => '?',
                'referrer' => '',
                'landing_id' => 'veritatis',
                'prelanding_id' => 'temporibus',
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
                'country_name' => 'dignissimos',
                'click_id' => 'vitae',
                'conversion_id' => 'consequatur',
                'has_conversions' => false,
                'cbid' => 'asperiores',
                'idfa' => 'mollitia',
                'isp' => 0,
                'uniq' => false,
                'partner' => [
                    'id' => 2,
                    'login' => '',
                    'email' => 'dino54@example.com',
                    'manager_id' => '5f9008bfafd0ba5d88c4dee8',
                    'name' => 'test',
                    'title' => 'test',
                ],
                'supplier_manager_id' => 'similique',
                'unid' => 'quidem',
            ],
        ];
    }

    public function testGetId(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);

        $this->assertEquals('5fcdfafd96f0b67522427bf2', $byServerPostbackDto->getId());
    }

    public function testGetGet(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8'], $byServerPostbackDto->getGet());
    }

    public function testGetPost(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(
            static::$requiredAttributes + ['_post' => ['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8']]
        );
        $this->assertEquals(['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8'], $byServerPostbackDto->getPost());

        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes + ['_post' => null]);
        $this->assertEmpty($byServerPostbackDto->getPost());

        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);
        $this->assertEmpty($byServerPostbackDto->getPost());
    }

    public function testGetServer(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);

        $this->assertEquals('quia', $byServerPostbackDto->getServer());
    }

    public function testGetSupplier(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(
            new SupplierDto(
                [
                    'id' => '5f059cf72bdea5690c593e53',
                    'title' => 'WC',
                ]
            ),
            $byServerPostbackDto->getSupplier()
        );
    }

    public function testGetDate(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(['sec' => 1607334653, 'usec' => 3207165000], $byServerPostbackDto->getDate());
    }

    public function testGetResponse(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);

        $this->assertEquals('{"status": 2,"message": "Broken clickid"}', $byServerPostbackDto->getResponse());
    }

    public function testGetTrack(): void
    {
        $byServerPostbackDto = new ByServerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(
            new TrackDto(
                [
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
                    'device_model' => 'iPhone 7 Plus|iPhone 8|iPhone 8 Plus|iPhone X',
                    'device_type' => 'mobile',
                    'city' => 'San Antonio',
                    'country' => 'US',
                    'city_id' => 76,
                    'district' => 'fuga',
                    'connection_type' => 'wi-fi',
                    'isp_code' => '?',
                    'referrer' => '',
                    'landing_id' => 'veritatis',
                    'prelanding_id' => 'temporibus',
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
                    'country_name' => 'dignissimos',
                    'click_id' => 'vitae',
                    'conversion_id' => 'consequatur',
                    'has_conversions' => false,
                    'cbid' => 'asperiores',
                    'idfa' => 'mollitia',
                    'isp' => 0,
                    'uniq' => false,
                    'partner' => [
                        'id' => 2,
                        'login' => '',
                        'email' => 'dino54@example.com',
                        'manager_id' => '5f9008bfafd0ba5d88c4dee8',
                        'name' => 'test',
                        'title' => 'test',
                    ],
                    'supplier_manager_id' => 'similique',
                    'unid' => 'quidem',
                ]
            ),
            $byServerPostbackDto->getTrack()
        );
    }
}
