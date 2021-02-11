<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\Affiliate\CustomFieldsDto;
use Affise\Sdk\Affiliate\PaymentSystemsDto;
use Affise\Sdk\User\Role;
use Affise\Sdk\User\UserDto;
use PHPUnit\Framework\TestCase;

/**
 * Class PartnerDtoTest
 */
class PartnerDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 8,
            'created_at' => '2020-09-24 15:49:49',
            'updated_at' => '2020-12-14 11:09:22',
            'email' => 'merl.jakubowski@example.net',
            'login' => 'Aminur@4343',
            'notes' => 'сетка, прислал скрин с affise',
            'manager' => [
                'id' => '5f9008bfafd0ba5d88c4dee8',
                'first_name' => 'Iren',
                'last_name' => 'FSgdfddws',
                'work_hours' => '19:42 - 16:46',
                'email' => 'miles.koss@example.org',
                'skype' => 'illum',
                'api_key' => '5e862f6be57613b95a730e4ff88e7b56',
                'roles' => [
                    Role::ROLE_MANAGER_AFFILIATE,
                    Role::ROLE_SECTION_OFFER,
                    Role::ROLE_SECTION_PARTNER,
                    Role::ROLE_SECTION_CATEGORY,
                    Role::ROLE_SECTION_DASHBOARD,
                    Role::ROLE_SECTION_TICKET,
                ],
                'updated_at' => '2020-12-14 11:03:15',
                'created_at' => '2020-10-21 13:09:03',
                'last_login_at' => '2020-11-04 11:10:03',
                'type' => 'affiliate_manager',
                'avatar' => 'dGVzdA==',
            ],
            'status' => 'active',
            'level' => 0,
            'payment_systems' => [
                [
                    'id' => 10895,
                    'active' => 0,
                    'system' => 'Webmoney WMR',
                    'fields' => ['...'],
                    'currency' => 1,
                    'system_id' => 1,
                ],
            ],
            'customFields' => [
                [
                    'name' => 'Last Name',
                    'value' => 'Aminur',
                    'label' => 'Aminur',
                    'id' => 2,
                ],
            ],
            'balance' => ['USD' => ['balance' => 0, 'hold' => 0, 'available' => 0]],
            'offersCount' => 5,
            'api_key' => 'c953bd90a6a715a5f95493c407840f5d',
            'country' => 'BJ',
            'sub_accounts' => [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
        ];
    }

    public function testGetId(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(8, $partnerDto->getId());
    }

    public function testGetCreatedAt(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('2020-09-24 15:49:49', $partnerDto->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('2020-12-14 11:09:22', $partnerDto->getUpdatedAt());
    }

    public function testGetEmail(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('merl.jakubowski@example.net', $partnerDto->getEmail());
    }

    public function testGetLogin(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('Aminur@4343', $partnerDto->getLogin());
    }

    public function testGetName(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['name' => 'test']);
        $this->assertEquals('test', $partnerDto->getName());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['name' => null]);
        $this->assertNull($partnerDto->getName());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getName());
    }

    public function testGetNotes(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('сетка, прислал скрин с affise', $partnerDto->getNotes());
    }

    public function testGetManager(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            new UserDto([
                'id' => '5f9008bfafd0ba5d88c4dee8',
                'first_name' => 'Iren',
                'last_name' => 'FSgdfddws',
                'work_hours' => '19:42 - 16:46',
                'email' => 'miles.koss@example.org',
                'skype' => 'illum',
                'api_key' => '5e862f6be57613b95a730e4ff88e7b56',
                'roles' => [
                    Role::ROLE_MANAGER_AFFILIATE,
                    Role::ROLE_SECTION_OFFER,
                    Role::ROLE_SECTION_PARTNER,
                    Role::ROLE_SECTION_CATEGORY,
                    Role::ROLE_SECTION_DASHBOARD,
                    Role::ROLE_SECTION_TICKET,
                ],
                'updated_at' => '2020-12-14 11:03:15',
                'created_at' => '2020-10-21 13:09:03',
                'last_login_at' => '2020-11-04 11:10:03',
                'type' => 'affiliate_manager',
                'avatar' => 'dGVzdA==',
            ]),
            $partnerDto->getManager()
        );
    }

    public function testGetStatus(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('active', $partnerDto->getStatus());
    }

    public function testGetLevel(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(0, $partnerDto->getLevel());
    }

    public function testGetPaymentSystems(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new PaymentSystemsDto(
                    [
                        'id' => 10895,
                        'active' => 0,
                        'system' => 'Webmoney WMR',
                        'fields' => ['...'],
                        'currency' => 1,
                        'system_id' => 1,
                    ]
                ),
            ],
            $partnerDto->getPaymentSystems()
        );
    }

    public function testGetCustomFields(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CustomFieldsDto(
                    [
                        'name' => 'Last Name',
                        'value' => 'Aminur',
                        'label' => 'Aminur',
                        'id' => 2,
                    ]
                ),
            ],
            $partnerDto->getCustomFields()
        );
    }

    public function testGetBalance(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(['USD' => ['balance' => 0, 'hold' => 0, 'available' => 0]], $partnerDto->getBalance());
    }

    public function testGetOffersCount(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(5, $partnerDto->getOffersCount());
    }

    public function testGetApiKey(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('c953bd90a6a715a5f95493c407840f5d', $partnerDto->getApiKey());
    }

    public function testGetCountry(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('BJ', $partnerDto->getCountry());
    }

    public function testGetSubAccounts(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
            $partnerDto->getSubAccounts()
        );
    }

    public function testGetContactPerson(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['contactPerson' => 'fugit']);
        $this->assertEquals('fugit', $partnerDto->getContactPerson());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['contactPerson' => null]);
        $this->assertNull($partnerDto->getContactPerson());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getContactPerson());
    }

    public function testGetRefPercent(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['ref_percent' => '1']);
        $this->assertEquals('1', $partnerDto->getRefPercent());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['ref_percent' => null]);
        $this->assertNull($partnerDto->getRefPercent());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getRefPercent());
    }

    public function testGetAddress1(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['address_1' => '222 Tillman Islands']);
        $this->assertEquals('222 Tillman Islands', $partnerDto->getAddress1());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['address_1' => null]);
        $this->assertNull($partnerDto->getAddress1());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getAddress1());
    }

    public function testGetAddress2(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['address_2' => '25123 Erica Island Suite 375']);
        $this->assertEquals('25123 Erica Island Suite 375', $partnerDto->getAddress2());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['address_2' => null]);
        $this->assertNull($partnerDto->getAddress2());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getAddress2());
    }

    public function testGetCity(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['city' => 'Bogisichport']);
        $this->assertEquals('Bogisichport', $partnerDto->getCity());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['city' => null]);
        $this->assertNull($partnerDto->getCity());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getCity());
    }

    public function testGetZipCode(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['zip_code' => 'quis']);
        $this->assertEquals('quis', $partnerDto->getZipCode());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['zip_code' => null]);
        $this->assertNull($partnerDto->getZipCode());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getZipCode());
    }

    public function testGetPhone(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['phone' => 'id']);
        $this->assertEquals('id', $partnerDto->getPhone());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['phone' => null]);
        $this->assertNull($partnerDto->getPhone());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getPhone());
    }

    public function testGetRef(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['ref' => 'qui']);
        $this->assertEquals('qui', $partnerDto->getRef());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['ref' => null]);
        $this->assertNull($partnerDto->getRef());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getRef());
    }

    public function testGetTags(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes + ['tags' => 'architecto']);
        $this->assertEquals('architecto', $partnerDto->getTags());

        $partnerDto = new PartnerDto(static::$requiredAttributes + ['tags' => null]);
        $this->assertNull($partnerDto->getTags());

        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertNull($partnerDto->getTags());
    }
}
