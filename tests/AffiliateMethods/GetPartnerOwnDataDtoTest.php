<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use PHPUnit\Framework\TestCase;

/**
 * Class GetPartnerOwnDataDtoTest
 */
class GetPartnerOwnDataDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'partner_id' => 2,
            'id' => '5f297e9a6dc8e2f008745d7c',
            'api_key' => 'ca30365558190b87c9fe1c496e467c2d',
            'created_at' => '2020-08-04T15:28:26Z',
            'email' => 'gleason.enrique@example.net',
            'status' => '1',
            'updated_at' => '2021-01-06T12:35:17Z',
            'ref' => '0',
            'lang' => 'en',
            'manager_id' => '5f9008bfafd0ba5d88c4dee8',
            'notes' => '',
            'ref_percent' => '0',
            'pay_acc' => '',
            'pay_acc_wmz' => '',
            'balance_ru' => 'voluptatem',
            'hold_ru' => 'quibusdam',
            'available_ru' => 'qui',
            'balance_usd' => 'blanditiis',
            'hold_usd' => 'optio',
            'available_usd' => 'atque',
            'address_1' => 'rthrth',
            'city' => 'rthrt',
            'country' => 'AE',
            'sub_accounts' => [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
            'tipalti_info' => '[]',
            'contact_person' => 'aliquid',
            'type' => 'affiliate',
            'permissions' => [
                'general' => ['marketplace' => ['level' => 'deny'], 'settings' => ['level' => 'deny']],
                'stats' => [
                    'affiliate-postback' => ['level' => 'read'],
                    'clicks-list' => ['level' => 'read'],
                    'comparison-report' => ['level' => 'read'],
                    'conversions-export' => ['level' => 'read'],
                    'conversions-import' => ['level' => 'deny'],
                    'conversions-list' => ['level' => 'read'],
                    'entity-account-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'entity-affiliate-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'referral' => ['level' => 'read'],
                    'server-postback' => ['level' => 'read'],
                    'slice-account_manager_id' => ['level' => 'read'],
                    'slice-advertiser_id' => ['level' => 'read'],
                    'slice-affiliate_id' => ['level' => 'read'],
                    'slice-affiliate_manager_id' => ['level' => 'read'],
                    'slice-browser' => ['level' => 'read'],
                    'slice-city' => ['level' => 'read'],
                    'slice-connection-type' => ['level' => 'read'],
                    'slice-country' => ['level' => 'read'],
                    'slice-day' => ['level' => 'read'],
                    'slice-device' => ['level' => 'read'],
                    'slice-goal' => ['level' => 'read'],
                    'slice-landing' => ['level' => 'read'],
                    'slice-mobile-carrier' => ['level' => 'read'],
                    'slice-offer_id' => ['level' => 'read'],
                    'slice-os' => ['level' => 'read'],
                    'slice-prelanding' => ['level' => 'read'],
                    'slice-smart_id' => ['level' => 'read'],
                    'slice-sub1' => ['level' => 'read'],
                    'slice-sub2' => ['level' => 'read'],
                    'slice-trafficback_reason' => ['level' => 'read'],
                    'stats-export' => ['level' => 'read'],
                    'view-custom' => ['level' => 'read'],
                    'view-kpi' => ['level' => 'read'],
                    'view-retention-rate' => ['level' => 'read'],
                ],
                'users' => [
                    'entity-account-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-advertiser' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-affiliate' => ['level' => 'deny', 'exceptions' => ['ints' => []]],
                    'entity-affiliate-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-common-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-preset' => ['level' => 'deny'],
                    'view-users' => ['level' => 'deny'],
                ],
            ],
            'work_hours' => '',
            'last_login_at' => '2021-01-20T09:55:07Z',
        ];
    }

    public function testGetPartnerId(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals(2, $getPartnerOwnDataDto->getPartnerId());
    }

    public function testGetId(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('5f297e9a6dc8e2f008745d7c', $getPartnerOwnDataDto->getId());
    }

    public function testGetApiKey(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('ca30365558190b87c9fe1c496e467c2d', $getPartnerOwnDataDto->getApiKey());
    }

    public function testGetCreatedAt(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('2020-08-04T15:28:26Z', $getPartnerOwnDataDto->getCreatedAt());
    }

    public function testGetEmail(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('gleason.enrique@example.net', $getPartnerOwnDataDto->getEmail());
    }

    public function testGetStatus(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('1', $getPartnerOwnDataDto->getStatus());
    }

    public function testGetUpdatedAt(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('2021-01-06T12:35:17Z', $getPartnerOwnDataDto->getUpdatedAt());
    }

    public function testGetRef(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('0', $getPartnerOwnDataDto->getRef());
    }

    public function testGetLang(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('en', $getPartnerOwnDataDto->getLang());
    }

    public function testGetManagerId(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('5f9008bfafd0ba5d88c4dee8', $getPartnerOwnDataDto->getManagerId());
    }

    public function testGetNotes(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('', $getPartnerOwnDataDto->getNotes());
    }

    public function testGetRefPercent(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('0', $getPartnerOwnDataDto->getRefPercent());
    }

    public function testGetPayAcc(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('', $getPartnerOwnDataDto->getPayAcc());
    }

    public function testGetPayAccWmz(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('', $getPartnerOwnDataDto->getPayAccWmz());
    }

    public function testGetBalanceRu(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('voluptatem', $getPartnerOwnDataDto->getBalanceRu());
    }

    public function testGetHoldRu(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('quibusdam', $getPartnerOwnDataDto->getHoldRu());
    }

    public function testGetAvailableRu(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('qui', $getPartnerOwnDataDto->getAvailableRu());
    }

    public function testGetBalanceUsd(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('blanditiis', $getPartnerOwnDataDto->getBalanceUsd());
    }

    public function testGetHoldUsd(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('optio', $getPartnerOwnDataDto->getHoldUsd());
    }

    public function testGetAvailableUsd(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('atque', $getPartnerOwnDataDto->getAvailableUsd());
    }

    public function testGetAddress1(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('rthrth', $getPartnerOwnDataDto->getAddress1());
    }

    public function testGetCity(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('rthrt', $getPartnerOwnDataDto->getCity());
    }

    public function testGetCountry(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('AE', $getPartnerOwnDataDto->getCountry());
    }

    public function testGetSubAccounts(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals(
            [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
            $getPartnerOwnDataDto->getSubAccounts()
        );
    }

    public function testGetTipaltiInfo(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('[]', $getPartnerOwnDataDto->getTipaltiInfo());
    }

    public function testGetContactPerson(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('aliquid', $getPartnerOwnDataDto->getContactPerson());
    }

    public function testGetType(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('affiliate', $getPartnerOwnDataDto->getType());
    }

    public function testGetPermissions(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'general' => ['marketplace' => ['level' => 'deny'], 'settings' => ['level' => 'deny']],
                'stats' => [
                    'affiliate-postback' => ['level' => 'read'],
                    'clicks-list' => ['level' => 'read'],
                    'comparison-report' => ['level' => 'read'],
                    'conversions-export' => ['level' => 'read'],
                    'conversions-import' => ['level' => 'deny'],
                    'conversions-list' => ['level' => 'read'],
                    'entity-account-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'entity-affiliate-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'referral' => ['level' => 'read'],
                    'server-postback' => ['level' => 'read'],
                    'slice-account_manager_id' => ['level' => 'read'],
                    'slice-advertiser_id' => ['level' => 'read'],
                    'slice-affiliate_id' => ['level' => 'read'],
                    'slice-affiliate_manager_id' => ['level' => 'read'],
                    'slice-browser' => ['level' => 'read'],
                    'slice-city' => ['level' => 'read'],
                    'slice-connection-type' => ['level' => 'read'],
                    'slice-country' => ['level' => 'read'],
                    'slice-day' => ['level' => 'read'],
                    'slice-device' => ['level' => 'read'],
                    'slice-goal' => ['level' => 'read'],
                    'slice-landing' => ['level' => 'read'],
                    'slice-mobile-carrier' => ['level' => 'read'],
                    'slice-offer_id' => ['level' => 'read'],
                    'slice-os' => ['level' => 'read'],
                    'slice-prelanding' => ['level' => 'read'],
                    'slice-smart_id' => ['level' => 'read'],
                    'slice-sub1' => ['level' => 'read'],
                    'slice-sub2' => ['level' => 'read'],
                    'slice-trafficback_reason' => ['level' => 'read'],
                    'stats-export' => ['level' => 'read'],
                    'view-custom' => ['level' => 'read'],
                    'view-kpi' => ['level' => 'read'],
                    'view-retention-rate' => ['level' => 'read'],
                ],
                'users' => [
                    'entity-account-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-advertiser' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-affiliate' => ['level' => 'deny', 'exceptions' => ['ints' => []]],
                    'entity-affiliate-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-common-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-preset' => ['level' => 'deny'],
                    'view-users' => ['level' => 'deny'],
                ],
            ],
            $getPartnerOwnDataDto->getPermissions()
        );
    }

    public function testGetWorkHours(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('', $getPartnerOwnDataDto->getWorkHours());
    }

    public function testGetLastLoginAt(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);

        $this->assertEquals('2021-01-20T09:55:07Z', $getPartnerOwnDataDto->getLastLoginAt());
    }

    public function testGetInfo(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['info' => 'voluptatem']);
        $this->assertEquals('voluptatem', $getPartnerOwnDataDto->getInfo());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['info' => null]);
        $this->assertNull($getPartnerOwnDataDto->getInfo());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getInfo());
    }

    public function testGetSettings(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['settings' => 'adipisci']);
        $this->assertEquals('adipisci', $getPartnerOwnDataDto->getSettings());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['settings' => null]);
        $this->assertNull($getPartnerOwnDataDto->getSettings());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getSettings());
    }

    public function testGetLogin(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['login' => 'animi']);
        $this->assertEquals('animi', $getPartnerOwnDataDto->getLogin());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['login' => null]);
        $this->assertNull($getPartnerOwnDataDto->getLogin());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getLogin());
    }

    public function testGetName(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['name' => 'Kathleen Witting']);
        $this->assertEquals('Kathleen Witting', $getPartnerOwnDataDto->getName());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['name' => null]);
        $this->assertNull($getPartnerOwnDataDto->getName());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getName());
    }

    public function testGetCompany(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['company' => 'Pollich LLC']);
        $this->assertEquals('Pollich LLC', $getPartnerOwnDataDto->getCompany());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['company' => null]);
        $this->assertNull($getPartnerOwnDataDto->getCompany());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getCompany());
    }

    public function testGetConfirmCode(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['confirm_code' => 'ullam']);
        $this->assertEquals('ullam', $getPartnerOwnDataDto->getConfirmCode());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['confirm_code' => null]);
        $this->assertNull($getPartnerOwnDataDto->getConfirmCode());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getConfirmCode());
    }

    public function testGetTimezone(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(
            static::$requiredAttributes + ['timezone' => 'America/Panama']
        );
        $this->assertEquals('America/Panama', $getPartnerOwnDataDto->getTimezone());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['timezone' => null]);
        $this->assertNull($getPartnerOwnDataDto->getTimezone());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getTimezone());
    }

    public function testGetLevel(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['level' => 'natus']);
        $this->assertEquals('natus', $getPartnerOwnDataDto->getLevel());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['level' => null]);
        $this->assertNull($getPartnerOwnDataDto->getLevel());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getLevel());
    }

    public function testGetPaySys(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['pay_sys' => 'autem']);
        $this->assertEquals('autem', $getPartnerOwnDataDto->getPaySys());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['pay_sys' => null]);
        $this->assertNull($getPartnerOwnDataDto->getPaySys());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getPaySys());
    }

    public function testGetAddress2(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(
            static::$requiredAttributes + ['address_2' => '609 Harmony Route']
        );
        $this->assertEquals('609 Harmony Route', $getPartnerOwnDataDto->getAddress2());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['address_2' => null]);
        $this->assertNull($getPartnerOwnDataDto->getAddress2());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getAddress2());
    }

    public function testGetZipCode(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['zip_code' => 'commodi']);
        $this->assertEquals('commodi', $getPartnerOwnDataDto->getZipCode());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['zip_code' => null]);
        $this->assertNull($getPartnerOwnDataDto->getZipCode());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getZipCode());
    }

    public function testGetPhone(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['phone' => 'voluptatem']);
        $this->assertEquals('voluptatem', $getPartnerOwnDataDto->getPhone());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['phone' => null]);
        $this->assertNull($getPartnerOwnDataDto->getPhone());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getPhone());
    }

    public function testGetTags(): void
    {
        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['tags' => 'neque']);
        $this->assertEquals('neque', $getPartnerOwnDataDto->getTags());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes + ['tags' => null]);
        $this->assertNull($getPartnerOwnDataDto->getTags());

        $getPartnerOwnDataDto = new GetPartnerOwnDataDto(static::$requiredAttributes);
        $this->assertNull($getPartnerOwnDataDto->getTags());
    }
}
