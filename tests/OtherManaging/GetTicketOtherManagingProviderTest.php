<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use Affise\Sdk\User\Role;
use PHPUnit\Framework\TestCase;

/**
 * Class GetTicketOtherManagingProviderTest
 */
class GetTicketOtherManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => '15',
            'status' => 'open',
            'type' => 'offer_request',
            'title' => 'Connect offer MT Adult Dating Smartlink CPL WW (81)',
            'description' => 'Emailing',
            'created' => '2020-11-07 18:30:45',
            'updated' => '2020-11-07 18:30:45',
            'attachments' => [],
            'comments' => ['answers' => 0, 'unread' => 0],
            'partner' => [
                'id' => 8,
                'created_at' => '2020-09-24 15:49:49',
                'updated_at' => '2020-12-14 11:09:22',
                'email' => 'borer.amelia@example.org',
                'login' => 'Aminur@4343',
                'ref_percent' => '0',
                'name' => '',
                'notes' => 'сетка, прислал скрин с affise',
                'manager' => [
                    'id' => '5f9008bfafd0ba5d88c4dee8',
                    'first_name' => 'Iren',
                    'last_name' => 'FSgdfddws',
                    'work_hours' => '12:47 - 18:32',
                    'email' => 'cordell13@example.org',
                    'skype' => 'alias',
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
                'address_1' => '45950 Elaina Shore Apt. 085',
                'address_2' => '956 Lucious Trafficway Apt. 033',
                'city' => 'New Erikastad',
                'country' => 'BJ',
                'zip_code' => 'pariatur',
                'phone' => 'nam',
                'ref' => 'accusantium',
                'sub_accounts' => [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
                'contactPerson' => 'nihil',
                'tags' => 'rerum',
            ],
            'offer' => [
                'id' => 81,
                'offer_id' => '5f61df8c134ed051008b4569',
                'title' => 'MT Adult Dating Smartlink CPL WW',
                'preview_url' => 'reprehenderit',
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
                'logo' => 'quos',
                'logo_source' => 'illum',
                'stop_at' => '2021-01-05T00:41:12+00:00',
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
                'strictly_country' => 'et',
                'strictly_os' => 'corporis',
                'strictly_brands' => 'est',
                'is_cpi' => false,
                'kpi' => [
                    'en' => '<p>Please only good quality traffic, we are 100% untollarante to any fraud or bad quality</p>',
                ],
                'creatives' => [],
                'creatives_zip' => 'et',
                'landings' => [],
                'links' => [],
                'macro_url' => '',
                'link' => 'vel',
                'use_https' => true,
                'use_http' => false,
                'hold_period' => 0,
                'click_session' => '1y',
                'minimal_click_session' => '0s',
                'disabled_choice_postback_status' => false,
                'strictly_isp' => [],
                'restriction_isp' => 'qui',
                'search_empty_sub' => 'sit',
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
                'io_document' => 'harum',
                'consider_personal_targeting_only' => false,
                'hosts_only' => false,
                'impressions_link' => 'nihil',
                'uniq_ip_only' => false,
                'reject_not_unique_ip' => false,
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetTicketResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/ticket/15')
            ->willReturn(
                [
                    'status' => 1,
                    'ticket' => $attributes,
                    'id' => '15',
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $response = $otherManagingProvider->getTicket('15');

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(TicketDto::class, $response->getData());
        $this->assertEquals(new TicketDto($attributes), $response->getData());
        $this->assertEquals('15', $response->getId());
    }

    /**
     * @param string $exceptionClass
     *
     * @psalm-param class-string<\Affise\Sdk\Exception\TransportException> $exceptionClass
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @dataProvider exceptionsProvider
     *
     * @psalm-suppress UnsafeInstantiation
     */
    public function testGetTicketFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherManagingProvider = new OtherManagingProvider($transport);

        $this->expectException($exceptionClass);

        $otherManagingProvider->getTicket('15');
    }

    /**
     * @return array<array<string>>
     * @psalm-return array<array<class-string<\Affise\Sdk\Exception\TransportException>>>
     */
    public function exceptionsProvider(): array
    {
        return [
            [AccessDeniedException::class],
            [BadRequestException::class],
            [EndpointNotFoundException::class],
            [TimeoutException::class],
            [TokenMissingException::class],
            [TransportException::class],
        ];
    }
}
