<?php

declare(strict_types=1);

namespace Affise\Sdk\Advertiser;

use Affise\Sdk\User\Role;
use Affise\Sdk\User\UserDto;
use PHPUnit\Framework\TestCase;

/**
* Class AdvertisersListDtoTest
*/
class AdvertisersListDtoTest extends TestCase
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
            'country' => 'AD',
            'sub_accounts' => [['value' => null,'except' => false],['value' => null,'except' => false]],
            'updated_at' => '2020-10-27 21:39:55',
            'consider_personal_targeting_only' => false,
            'tags' => ['test'],
            'hosts_only' => false,
            'offers' => 0,
            'has_user' => false,
        ];
    }

    public function testGetId(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals('5b5f415035752723008b456a', $advertiserListDto->getId());
    }

    public function testGetTitle(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals('Test supplier', $advertiserListDto->getTitle());
    }

    public function testGetManager(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals('5ef49b78885352fa094eb7cd', $advertiserListDto->getManager());
    }

    public function testGetManagerObj(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

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
            $advertiserListDto->getManagerObj()
        );
    }

    public function testGetAllowedIp(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEmpty($advertiserListDto->getAllowedIp());
    }

    public function testGetDisallowedIp(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEmpty($advertiserListDto->getDisallowedIp());
    }

    public function testGetCountry(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals('AD', $advertiserListDto->getCountry());
    }

    public function testGetSubAccounts(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals([['value' => null,'except' => false],['value' => null,'except' => false]], $advertiserListDto->getSubAccounts());
    }

    public function testGetContact(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['contact' => 'omnis']);
        $this->assertEquals('omnis', $advertiserListDto->getContact());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['contact' => null]);
        $this->assertNull($advertiserListDto->getContact());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getContact());
    }

    public function testGetEmail(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['email' => 'vdavis@example.org']);
        $this->assertEquals('vdavis@example.org', $advertiserListDto->getEmail());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['email' => null]);
        $this->assertNull($advertiserListDto->getEmail());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getEmail());
    }

    public function testGetUrl(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['url' => 'http://www.olson.org/impedit-dolore-ut-eos-molestiae-dolorem.html']);
        $this->assertEquals('http://www.olson.org/impedit-dolore-ut-eos-molestiae-dolorem.html', $advertiserListDto->getUrl());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['url' => null]);
        $this->assertNull($advertiserListDto->getUrl());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getUrl());
    }

    public function testGetSkype(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['skype' => 'voluptatum']);
        $this->assertEquals('voluptatum', $advertiserListDto->getSkype());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['skype' => null]);
        $this->assertNull($advertiserListDto->getSkype());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getSkype());
    }

    public function testGetNote(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['note' => 'recusandae']);
        $this->assertEquals('recusandae', $advertiserListDto->getNote());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['note' => null]);
        $this->assertNull($advertiserListDto->getNote());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getNote());
    }

    public function testGetAddress1(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['address_1' => '58824 Aniya Brook']);
        $this->assertEquals('58824 Aniya Brook', $advertiserListDto->getAddress1());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['address_1' => null]);
        $this->assertNull($advertiserListDto->getAddress1());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getAddress1());
    }

    public function testGetAddress2(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['address_2' => '4707 Waters Lake Suite 743']);
        $this->assertEquals('4707 Waters Lake Suite 743', $advertiserListDto->getAddress2());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['address_2' => null]);
        $this->assertNull($advertiserListDto->getAddress2());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getAddress2());
    }

    public function testGetCity(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['city' => 'West Abe']);
        $this->assertEquals('West Abe', $advertiserListDto->getCity());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['city' => null]);
        $this->assertNull($advertiserListDto->getCity());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getCity());
    }

    public function testGetZipCode(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['zip_code' => 'eligendi']);
        $this->assertEquals('eligendi', $advertiserListDto->getZipCode());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['zip_code' => null]);
        $this->assertNull($advertiserListDto->getZipCode());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getZipCode());
    }

    public function testGetVatCode(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['vat_code' => 'omnis']);
        $this->assertEquals('omnis', $advertiserListDto->getVatCode());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['vat_code' => null]);
        $this->assertNull($advertiserListDto->getVatCode());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getVatCode());
    }

    public function testGetUpdatedAt(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals('2020-10-27 21:39:55', $advertiserListDto->getUpdatedAt());
    }

    public function testGetConsiderPersonalTargetingOnly(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $advertiserListDto->getConsiderPersonalTargetingOnly());
    }

    public function testGetTags(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals(['test'], $advertiserListDto->getTags());
    }

    public function testGetHostsOnly(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $advertiserListDto->getHostsOnly());
    }

    public function testGetHashPassword(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['hash_password' => 'f271b15d2887fd6d64c0204d5584d3c1eb3c9c6c']);
        $this->assertEquals('f271b15d2887fd6d64c0204d5584d3c1eb3c9c6c', $advertiserListDto->getHashPassword());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes + ['hash_password' => null]);
        $this->assertNull($advertiserListDto->getHashPassword());

        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);
        $this->assertNull($advertiserListDto->getHashPassword());
    }

    public function testGetOffers(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals(0, $advertiserListDto->getOffers());
    }

    public function testGetHasUser(): void
    {
        $advertiserListDto = new AdvertisersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $advertiserListDto->getHasUser());
    }
}
