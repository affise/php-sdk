<?php

declare(strict_types=1);

namespace Affise\Sdk\Advertiser;

use Affise\Sdk\User\Role;
use Affise\Sdk\User\UserDto;
use PHPUnit\Framework\TestCase;

/**
* Class AdvertiserDtoTest
*/
class AdvertiserDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5b5f415035752723008b456a',
            'title' => 'Test supplier',
            'manager' => '5ef49b78885352fa094eb7cd',
            'manager_obj' => [
                'id' => '5ef49b78885352fa094eb7cd',
                'first_name' => 'Irina',
                'last_name' => 'SGSWWGfg',
                'work_hours' => '10:00 - 19:00',
                'email' => 'sdfgdfs@example.com',
                'api_key' => '5b6e54d325b57da37f2a8138e51b8e3d',
                'roles' => [
                    Role::ROLE_SECTION_SUPPLIER,
                    Role::ROLE_SECTION_AUTOMATION,
                    Role::ROLE_SECTION_DASHBOARD,
                    Role::ROLE_SECTION_NEWS,
                    Role::ROLE_SECTION_OFFER,
                ],
                'updated_at' => '2020-12-14 11:03:22',
                'created_at' => '2020-06-25 15:43:26',
                'last_login_at' => '2020-10-27 15:46:33',
                'type' => 'account_manager',
            ],
            'allowed_ip' => [],
            'disallowed_ip' => [],
            'sub_accounts' => [['value' => null,'except' => false],['value' => null,'except' => false]],
            'updated_at' => '2020-10-27 21:39:55',
            'consider_personal_targeting_only' => false,
            'tags' => ['test'],
            'hosts_only' => false,
        ];
    }

    public function testGetId(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals('5b5f415035752723008b456a', $getAdvertiserDto->getId());
    }

    public function testGetTitle(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals('Test supplier', $getAdvertiserDto->getTitle());
    }

    public function testGetManager(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals('5ef49b78885352fa094eb7cd', $getAdvertiserDto->getManager());
    }

    public function testGetManagerObj(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals(
            new UserDto(
                [
                    'id' => '5ef49b78885352fa094eb7cd',
                    'first_name' => 'Irina',
                    'last_name' => 'SGSWWGfg',
                    'work_hours' => '10:00 - 19:00',
                    'email' => 'sdfgdfs@example.com',
                    'api_key' => '5b6e54d325b57da37f2a8138e51b8e3d',
                    'roles' => [
                        Role::ROLE_SECTION_SUPPLIER,
                        Role::ROLE_SECTION_AUTOMATION,
                        Role::ROLE_SECTION_DASHBOARD,
                        Role::ROLE_SECTION_NEWS,
                        Role::ROLE_SECTION_OFFER,
                    ],
                    'updated_at' => '2020-12-14 11:03:22',
                    'created_at' => '2020-06-25 15:43:26',
                    'last_login_at' => '2020-10-27 15:46:33',
                    'type' => 'account_manager',
                ]
            ),
            $getAdvertiserDto->getManagerObj()
        );
    }

    public function testGetAllowedIp(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEmpty($getAdvertiserDto->getAllowedIp());
    }

    public function testGetDisallowedIp(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEmpty($getAdvertiserDto->getDisallowedIp());
    }

    public function testGetCountry(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['country' => 'AD']);
        $this->assertEquals('AD', $getAdvertiserDto->getCountry());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['country' => null]);
        $this->assertNull($getAdvertiserDto->getCountry());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getCountry());
    }

    public function testGetSubAccounts(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals([['value' => null,'except' => false],['value' => null,'except' => false]], $getAdvertiserDto->getSubAccounts());
    }

    public function testGetContact(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['contact' => 'omnis']);
        $this->assertEquals('omnis', $getAdvertiserDto->getContact());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['contact' => null]);
        $this->assertNull($getAdvertiserDto->getContact());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getContact());
    }

    public function testGetEmail(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['email' => 'vdavis@example.org']);
        $this->assertEquals('vdavis@example.org', $getAdvertiserDto->getEmail());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['email' => null]);
        $this->assertNull($getAdvertiserDto->getEmail());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getEmail());
    }

    public function testGetUrl(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['url' => 'http://www.olson.org/impedit-dolore-ut-eos-molestiae-dolorem.html']);
        $this->assertEquals('http://www.olson.org/impedit-dolore-ut-eos-molestiae-dolorem.html', $getAdvertiserDto->getUrl());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['url' => null]);
        $this->assertNull($getAdvertiserDto->getUrl());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getUrl());
    }

    public function testGetSkype(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['skype' => 'voluptatum']);
        $this->assertEquals('voluptatum', $getAdvertiserDto->getSkype());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['skype' => null]);
        $this->assertNull($getAdvertiserDto->getSkype());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getSkype());
    }

    public function testGetNote(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['note' => 'recusandae']);
        $this->assertEquals('recusandae', $getAdvertiserDto->getNote());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['note' => null]);
        $this->assertNull($getAdvertiserDto->getNote());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getNote());
    }

    public function testGetAddress1(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['address_1' => '58824 Aniya Brook']);
        $this->assertEquals('58824 Aniya Brook', $getAdvertiserDto->getAddress1());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['address_1' => null]);
        $this->assertNull($getAdvertiserDto->getAddress1());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getAddress1());
    }

    public function testGetAddress2(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['address_2' => '4707 Waters Lake Suite 743']);
        $this->assertEquals('4707 Waters Lake Suite 743', $getAdvertiserDto->getAddress2());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['address_2' => null]);
        $this->assertNull($getAdvertiserDto->getAddress2());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getAddress2());
    }

    public function testGetCity(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['city' => 'West Abe']);
        $this->assertEquals('West Abe', $getAdvertiserDto->getCity());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['city' => null]);
        $this->assertNull($getAdvertiserDto->getCity());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getCity());
    }

    public function testGetZipCode(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['zip_code' => 'eligendi']);
        $this->assertEquals('eligendi', $getAdvertiserDto->getZipCode());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['zip_code' => null]);
        $this->assertNull($getAdvertiserDto->getZipCode());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getZipCode());
    }

    public function testGetVatCode(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['vat_code' => 'omnis']);
        $this->assertEquals('omnis', $getAdvertiserDto->getVatCode());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['vat_code' => null]);
        $this->assertNull($getAdvertiserDto->getVatCode());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getVatCode());
    }

    public function testGetUpdatedAt(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals('2020-10-27 21:39:55', $getAdvertiserDto->getUpdatedAt());
    }

    public function testGetConsiderPersonalTargetingOnly(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals(false, $getAdvertiserDto->getConsiderPersonalTargetingOnly());
    }

    public function testGetTags(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals(['test'], $getAdvertiserDto->getTags());
    }

    public function testGetHostsOnly(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals(false, $getAdvertiserDto->getHostsOnly());
    }

    public function testGetHashPassword(): void
    {
        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['hash_password' => 'f271b15d2887fd6d64c0204d5584d3c1eb3c9c6c']);
        $this->assertEquals('f271b15d2887fd6d64c0204d5584d3c1eb3c9c6c', $getAdvertiserDto->getHashPassword());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes + ['hash_password' => null]);
        $this->assertNull($getAdvertiserDto->getHashPassword());

        $getAdvertiserDto = new AdvertiserDto(static::$requiredAttributes);
        $this->assertNull($getAdvertiserDto->getHashPassword());
    }
}
