<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use Affise\Sdk\User\Role;
use Affise\Sdk\User\UserDto;
use PHPUnit\Framework\TestCase;

/**
* Class AffiliateDtoTest
*/
class AffiliateDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 1,
            'created_at' => '2020-06-12 16:53:02',
            'updated_at' => '2015-08-25 22:10:16',
            'email' => 'garrison.volkman@example.org',
            'login' => 'laboriosam',
            'ref_percent' => '0',
            'notes' => '',
            'status' => 'active',
            'level' => 0,
            'manager' => [
                'id' => '5cd5530ad596c1c0008b4567',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'work_hours' => '24',
                'email' => 'admin@admin.adm',
                'skype' => 'admin',
                'api_key' => '7eed552d6477f30f4b66fa663c4dfcab42eee7a4',
                'roles' => [Role::ROLE_MANAGER_AFFILIATE],
                'updated_at' => '2020-12-26T10:20:08+00:00',
                'type' => UserDto::TYPE_AFFILIATE_MANAGER,
            ],
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
                    'name' => 'Skype',
                    'value' => '1',
                    'label' => '1',
                    'id' => 1,
                ],
            ],
            'balance' => ['USD' => ['balance' => 65.632, 'hold' => 0, 'available' => 65.632]],
            'offersCount' => 35,
            'ref' => '0',
            'sub_accounts' => [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
            'tags' => [],
        ];
    }

    public function testGetId(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals(1, $getAffiliateDto->getId());
    }

    public function testGetCreatedAt(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('2020-06-12 16:53:02', $getAffiliateDto->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('2015-08-25 22:10:16', $getAffiliateDto->getUpdatedAt());
    }

    public function testGetEmail(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('garrison.volkman@example.org', $getAffiliateDto->getEmail());
    }

    public function testGetLogin(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('laboriosam', $getAffiliateDto->getLogin());
    }

    public function testGetRefPercent(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('0', $getAffiliateDto->getRefPercent());
    }

    public function testGetNotes(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('', $getAffiliateDto->getNotes());
    }

    public function testGetStatus(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('active', $getAffiliateDto->getStatus());
    }

    public function testGetLevel(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals(0, $getAffiliateDto->getLevel());
    }

    public function testGetPaymentSystems(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

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
            $getAffiliateDto->getPaymentSystems()
        );
    }

    public function testGetCustomFields(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CustomFieldsDto(
                    [
                        'name' => 'Skype',
                        'value' => '1',
                        'label' => '1',
                        'id' => 1,
                    ]
                ),
            ],
            $getAffiliateDto->getCustomFields()
        );
    }

    public function testGetBalance(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals(['USD' => ['balance' => 65.632, 'hold' => 0, 'available' => 65.632]], $getAffiliateDto->getBalance());
    }

    public function testGetOffersCount(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals(35, $getAffiliateDto->getOffersCount());
    }

    public function testGetApiKey(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['api_key' => '19673476a51fe659657ca8151644a28c']);
        $this->assertEquals('19673476a51fe659657ca8151644a28c', $getAffiliateDto->getApiKey());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['api_key' => null]);
        $this->assertNull($getAffiliateDto->getApiKey());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getApiKey());
    }

    public function testGetRef(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('0', $getAffiliateDto->getRef());
    }

    public function testGetSubAccounts(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals([['value' => '', 'except' => 0], ['value' => '', 'except' => 0]], $getAffiliateDto->getSubAccounts());
    }

    public function testGetTags(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals([], $getAffiliateDto->getTags());
    }

    public function testGetName(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['name' => 'Davon Ferry V']);
        $this->assertEquals('Davon Ferry V', $getAffiliateDto->getName());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['name' => null]);
        $this->assertNull($getAffiliateDto->getName());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getName());
    }

    public function testGetManager(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertEquals(
            new UserDto(
                [
                    'id' => '5cd5530ad596c1c0008b4567',
                    'first_name' => 'admin',
                    'last_name' => 'admin',
                    'work_hours' => '24',
                    'email' => 'admin@admin.adm',
                    'skype' => 'admin',
                    'api_key' => '7eed552d6477f30f4b66fa663c4dfcab42eee7a4',
                    'roles' => [Role::ROLE_MANAGER_AFFILIATE],
                    'updated_at' => '2020-12-26T10:20:08+00:00',
                    'type' => UserDto::TYPE_AFFILIATE_MANAGER,
                ]
            ),
            $getAffiliateDto->getManager()
        );
    }

    public function testGetAddress1(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['address_1' => '836 Rippin Drives Suite 508']);
        $this->assertEquals('836 Rippin Drives Suite 508', $getAffiliateDto->getAddress1());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['address_1' => null]);
        $this->assertNull($getAffiliateDto->getAddress1());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getAddress1());
    }

    public function testGetAddress2(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['address_2' => '2496 Koepp Harbor Suite 726']);
        $this->assertEquals('2496 Koepp Harbor Suite 726', $getAffiliateDto->getAddress2());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['address_2' => null]);
        $this->assertNull($getAffiliateDto->getAddress2());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getAddress2());
    }

    public function testGetCity(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['city' => 'Gutmannbury']);
        $this->assertEquals('Gutmannbury', $getAffiliateDto->getCity());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['city' => null]);
        $this->assertNull($getAffiliateDto->getCity());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getCity());
    }

    public function testGetCountry(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['country' => 'US']);
        $this->assertEquals('US', $getAffiliateDto->getCountry());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['country' => null]);
        $this->assertNull($getAffiliateDto->getCountry());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getCountry());
    }

    public function testGetZipCode(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['zip_code' => 'laboriosam']);
        $this->assertEquals('laboriosam', $getAffiliateDto->getZipCode());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['zip_code' => null]);
        $this->assertNull($getAffiliateDto->getZipCode());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getZipCode());
    }

    public function testGetPhone(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['phone' => 'ut']);
        $this->assertEquals('ut', $getAffiliateDto->getPhone());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['phone' => null]);
        $this->assertNull($getAffiliateDto->getPhone());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getPhone());
    }

    public function testGetContactPerson(): void
    {
        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['contactPerson' => 'culpa']);
        $this->assertEquals('culpa', $getAffiliateDto->getContactPerson());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes + ['contactPerson' => null]);
        $this->assertNull($getAffiliateDto->getContactPerson());

        $getAffiliateDto = new AffiliateDto(static::$requiredAttributes);
        $this->assertNull($getAffiliateDto->getContactPerson());
    }
}
