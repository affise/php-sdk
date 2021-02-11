<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\User\Role;
use PHPUnit\Framework\TestCase;

/**
 * Class TicketDtoTest
 */
class TicketDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '15',
            'status' => 'open',
            'type' => 'offer_request',
            'title' => 'Connect offer MT Adult Dating Smartlink CPL WW (81)',
            'description' => 'Emailing',
            'created' => '2020-11-07 18:30:45',
            'attachments' => [],
            'comments' => ['answers' => 0, 'unread' => 0],
            'partner' => [
                'id' => 8,
                'created_at' => '2020-09-24 15:49:49',
                'updated_at' => '2020-12-14 11:09:22',
                'email' => 'merl.jakubowski@example.net',
                'login' => 'Aminur@4343',
                'name' => '',
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
                'payment_systems' => [],
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
                'contactPerson' => 'fugit',
            ],
            'offer' => [
                'id' => 81,
                'offer_id' => '5f61df8c134ed051008b4569',
                'title' => 'MT Adult Dating Smartlink CPL WW',
                'preview_url' => 'quidem',
                'cross_postback_url' => '',
                'description_lang' => [
                    'ru' => '',
                    'en' => '',
                    'cn' => '',
                    'es' => '',
                    'ka' => '',
                    'vi' => '',
                    'my' => '',
                    'pt' => '',
                ],
                'cr' => 0,
                'epc' => 0,
                'send_emails' => false,
                'logo' => 'consequatur',
                'logo_source' => 'dolores',
                'sources' => [
                    [
                        'id' => '51f531f53b7d9b1e0382f6d9',
                        'title' => 'Web sites',
                        'allowed' => 1,
                    ],
                ],
                'categories' => [],
                'full_categories' => [],
                'payments' => [
                    [
                        'countries' => [],
                        'cities' => [],
                        'country_exclude' => false,
                        'title' => '',
                        'goal' => '1',
                        'revenue' => 75,
                        'currency' => 'USD',
                        'type' => 'percent',
                        'devices' => [],
                        'os' => [],
                    ],
                ],
                'goals' => [''],
                'caps' => [],
                'caps_timezone' => 'Europe/Moscow',
                'hide_caps' => 0,
                'required_approval' => true,
                'is_cpi' => false,
                'kpi' => [
                    'en' => '<p>Please only good quality traffic, we are 100% untollarante to any fraud or bad quality</p>',
                ],
                'creatives' => [],
                'landings' => [],
                'links' => [],
                'macro_url' => '',
                'use_https' => true,
                'use_http' => false,
                'hold_period' => 0,
                'click_session' => '1y',
                'minimal_click_session' => '0s',
                'disabled_choice_postback_status' => false,
                'strictly_isp' => [],
                'targeting' => [
                    [
                        'country' => ['allow' => [], 'deny' => []],
                        'region' => ['allow' => [], 'deny' => []],
                        'city' => ['allow' => [], 'deny' => []],
                        'os' => ['allow' => [], 'deny' => []],
                        'isp' => ['allow' => [], 'deny' => []],
                        'ip' => ['allow' => [], 'deny' => []],
                        'browser' => ['allow' => [], 'deny' => []],
                        'brand' => ['allow' => [], 'deny' => []],
                        'device_type' => [],
                        'connection' => [],
                        'affiliate_id' => [],
                        'sub' => ['allow' => [], 'deny' => [], 'deny_groups' => []],
                        'url' => '',
                        'block_proxy' => false,
                    ],
                ],
                'schedule' => ['enabled' => false, 'date_start' => '', 'date_to' => '', 'timezone' => 'Europe/Moscow'],
                'consider_personal_targeting_only' => false,
                'hosts_only' => false,
                'uniq_ip_only' => false,
                'reject_not_unique_ip' => false,
            ],
        ];
    }

    public function testGetId(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals('15', $getTicketDto->getId());
    }

    public function testGetStatus(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals('open', $getTicketDto->getStatus());
    }

    public function testGetType(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals('offer_request', $getTicketDto->getType());
    }

    public function testGetTitle(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals('Connect offer MT Adult Dating Smartlink CPL WW (81)', $getTicketDto->getTitle());
    }

    public function testGetDescription(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals('Emailing', $getTicketDto->getDescription());
    }

    public function testGetCreated(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals('2020-11-07 18:30:45', $getTicketDto->getCreated());
    }

    public function testGetUpdated(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes + ['updated' => '2020-11-07 18:30:45']);
        $this->assertEquals('2020-11-07 18:30:45', $getTicketDto->getUpdated());

        $getTicketDto = new TicketDto(static::$requiredAttributes + ['updated' => null]);
        $this->assertNull($getTicketDto->getUpdated());

        $getTicketDto = new TicketDto(static::$requiredAttributes);
        $this->assertNull($getTicketDto->getUpdated());
    }

    public function testGetAttachments(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals([], $getTicketDto->getAttachments());
    }

    public function testGetComments(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals(['answers' => 0, 'unread' => 0], $getTicketDto->getComments());
    }

    public function testGetPartner(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals(
            new PartnerDto([
                'id' => 8,
                'created_at' => '2020-09-24 15:49:49',
                'updated_at' => '2020-12-14 11:09:22',
                'email' => 'merl.jakubowski@example.net',
                'login' => 'Aminur@4343',
                'name' => '',
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
                'payment_systems' => [],
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
                'contactPerson' => 'fugit',
            ]),
            $getTicketDto->getPartner()
        );
    }

    public function testGetOffer(): void
    {
        $getTicketDto = new TicketDto(static::$requiredAttributes);

        $this->assertEquals(
            new OfferDto([
                'id' => 81,
                'offer_id' => '5f61df8c134ed051008b4569',
                'title' => 'MT Adult Dating Smartlink CPL WW',
                'preview_url' => 'quidem',
                'cross_postback_url' => '',
                'description_lang' => [
                    'ru' => '',
                    'en' => '',
                    'cn' => '',
                    'es' => '',
                    'ka' => '',
                    'vi' => '',
                    'my' => '',
                    'pt' => '',
                ],
                'cr' => 0,
                'epc' => 0,
                'send_emails' => false,
                'logo' => 'consequatur',
                'logo_source' => 'dolores',
                'sources' => [
                    [
                        'id' => '51f531f53b7d9b1e0382f6d9',
                        'title' => 'Web sites',
                        'allowed' => 1,
                    ],
                ],
                'categories' => [],
                'full_categories' => [],
                'payments' => [
                    [
                        'countries' => [],
                        'cities' => [],
                        'country_exclude' => false,
                        'title' => '',
                        'goal' => '1',
                        'revenue' => 75,
                        'currency' => 'USD',
                        'type' => 'percent',
                        'devices' => [],
                        'os' => [],
                    ],
                ],
                'goals' => [''],
                'caps' => [],
                'caps_timezone' => 'Europe/Moscow',
                'hide_caps' => 0,
                'required_approval' => true,
                'is_cpi' => false,
                'kpi' => [
                    'en' => '<p>Please only good quality traffic, we are 100% untollarante to any fraud or bad quality</p>',
                ],
                'creatives' => [],
                'landings' => [],
                'links' => [],
                'macro_url' => '',
                'use_https' => true,
                'use_http' => false,
                'hold_period' => 0,
                'click_session' => '1y',
                'minimal_click_session' => '0s',
                'disabled_choice_postback_status' => false,
                'strictly_isp' => [],
                'targeting' => [
                    [
                        'country' => ['allow' => [], 'deny' => []],
                        'region' => ['allow' => [], 'deny' => []],
                        'city' => ['allow' => [], 'deny' => []],
                        'os' => ['allow' => [], 'deny' => []],
                        'isp' => ['allow' => [], 'deny' => []],
                        'ip' => ['allow' => [], 'deny' => []],
                        'browser' => ['allow' => [], 'deny' => []],
                        'brand' => ['allow' => [], 'deny' => []],
                        'device_type' => [],
                        'connection' => [],
                        'affiliate_id' => [],
                        'sub' => ['allow' => [], 'deny' => [], 'deny_groups' => []],
                        'url' => '',
                        'block_proxy' => false,
                    ],
                ],
                'schedule' => ['enabled' => false, 'date_start' => '', 'date_to' => '', 'timezone' => 'Europe/Moscow'],
                'consider_personal_targeting_only' => false,
                'hosts_only' => false,
                'uniq_ip_only' => false,
                'reject_not_unique_ip' => false,
            ]),
            $getTicketDto->getOffer()
        );
    }
}
