<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class OffersListOffersProviderTest
 */
class OffersListOffersProviderTest extends TestCase
{
    private static array $attributes;
    private static array $partnerAttributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'id' => 331,
                'offer_id' => '5bdffa7339f65625008b4568',
                'advertiser' => '5bc9d7c16d73e41c008b4567',
                'external_offer_id' => '',
                'bundle_id' => '',
                'hide_payments' => false,
                'title' => 'blabla',
                'macro_url' => '',
                'url' => '',
                'cross_postback_url' => 'qui',
                'url_preview' => '',
                'preview_url' => '',
                'domain_url' => '',
                'trafficback_url' => '',
                'use_https' => true,
                'use_http' => true,
                'description_lang' => ['ru' => 'Описание', 'en' => 'Description'],
                'sources' => [
                    [
                        'id' => '51f531f53b7d9b1e0382f6d9',
                        'title' => 'Web sites',
                        'allowed' => 1,

                    ],
                ],
                'logo' => 'reiciendis',
                'logo_source' => '',
                'status' => 'active',
                'tags' => [],
                'privacy' => 'public',
                'is_top' => 0,
                'payments' => [
                    [
                        'countries' => ['kz'],
                        'cities' => [
                            [
                                'country_code' => 'KZ',
                                'id' => 563497,
                                'name' => 'Maksut',
                                'region_code' => 30,

                            ],
                        ],
                        'devices' => [],
                        'os' => [],
                        'goal' => '1',
                        'revenue' => 500.75,
                        'currency' => 'usd',
                        'title' => 'goal1',
                        'type' => 'fixed',
                        'country_exclude' => false,
                        'total' => 1000.25,
                        'with_regions' => false,

                    ],
                ],
                'partner_payments' => [],
                'landings' => [
                    [
                        'id' => 1,
                        'title' => 'Mr.',
                        'url' => 'http://affise.com',
                        'url_preview' => 'fugit',
                        'type' => 'landing',

                    ],
                ],
                'strictly_country' => 0,
                'strictly_os' => [],
                'strictly_brands' => [],
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

                    ],
                ],
                'is_redirect_overcap' => false,
                'notice_percent_overcap' => 0,
                'hold_period' => 0,
                'categories' => ['...', '...'],
                'full_categories' => [
                    ['id' => '5368afb23b7d9b4d5d505342', 'title' => '...'],
                    ['id' => '55b204663b7d9b460b8b45b2', 'title' => '...'],
                ],
                'cr' => 0,
                'epc' => 0,
                'notes' => '',
                'allowed_ip' => '',
                'disallowed_ip' => '',
                'hash_password' => '',
                'allow_deeplink' => false,
                'hide_referer' => false,
                'start_at' => '2018-11-06 12:35:00',
                'stop_at' => '',
                'auto_offer_connect' => 0,
                'required_approval' => false,
                'is_cpi' => false,
                'creatives' => [],
                'created_at' => '2018-11-05 11:08:19',
                'sub_accounts' => [['value' => '', 'except' => false], ['value' => '', 'except' => false]],
                'kpi' => ['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''],
                'strictly_isp' => [],
                'caps' => [
                    [
                        'period' => 'day',
                        'type' => 'conversions',
                        'value' => 100,
                        'goal_type' => 'exact',
                        'goals' => ['Install'],
                        'affiliate_type' => 'exact',
                        'affiliates' => [500, 600],
                        'country_type' => 'all',
                    ],
                ],
                'commission_tiers' => [
                    [
                        'affiliate_type' => 'exact',
                        'affiliates' => [1],
                        'goals' => [],
                        'timeframe' => 'month',
                        'type' => 'budget',
                        'value' => 55.6,
                        'target_goals' => [],
                        'modifier_type' => 'to_percent',
                        'modifier_value' => 10.02,
                        'modifier_payment_type' => 'payout',

                    ],
                ],
                'updated_at' => '2019-02-08 10:03:38',
                'allow_impressions' => false,
                'smartlink_categories' => [],
                'uniq_ip_only' => false,
                'reject_not_uniq_ip' => false,

            ],
        ];

        static::$partnerAttributes = [
            [
                'id' => 11,
                'offer_id' => '5f05f2f5134ed05c008b4568',
                'title' => 'Varmogvillig.com CPL DOI NO WEB\\TAB\\MOB',
                'preview_url' => 'https://www.varmogvillig.com/landing2',
                'description_lang' =>
                    [
                        'ru' => '<p>This offer requires approval from your AM</p>',
                        'en' => '<p>This offer requires approval from your AM</p>',
                    ],
                'logo' => 'https://offers-mediatransits.affise.com/images/cpa/logos/634014133.png',
                'logo_source' => '634014133.png',
                'stop_at' => '',
                'sources' => [
                    [
                        'id' => '51f531f53b7d9b1e0382f6d9',
                        'title' => 'Web sites',
                        'allowed' => 1,
                    ],
                ],
                'categories' => ['Dating Adult'],
                'full_categories' => [
                    [
                        'id' => '5f1845f9134ed050008b4568',
                        'title' => 'Dating Adult',
                    ], 
                ],
                'payments' => [
                    [
                        'countries' => ['NO'],
                        'cities' => [],
                        'devices' => [],
                        'os' => [],
                        'goal' => '1',
                        'revenue' => 17.57,
                        'currency' => 'usd',
                        'title' => '',
                        'type' => 'fixed',
                        'country_exclude' => false,
                    ],
                ],
                'caps' => [],
                'required_approval' => true,
                'strictly_country' => 0,
                'strictly_os' => [],
                'strictly_brands' => [],
                'is_cpi' => false,
                'creatives' => [],
                'creatives_zip' => null,
                'impressions_link' => null,
                'landings' => [],
                'links' => [
                    [
                        'id' => null,
                        'title' => null,
                        'hash' => null,
                        'url' => 'https://mediatransits.g2afse.com/click?pid=2&offer_id=11',
                        'postbacks' => [],
                        'created' => null,
                    ],   
                ],
                'macro_url' => null,
                'link' => 'https://mediatransits.g2afse.com/click?pid=2&offer_id=11',
                'use_https' => true,
                'use_http' => false,
                'hold_period' => 0,
                'kpi' => [
                    'en' => '<p>Not fans of pop traffic</p>',
                ],
                'click_session' => '1y',
                'minimal_click_session' => '0s',
                'strictly_isp' => [],
                'restriction_isp' => [],
                'targeting' => [
                    [
                        'country' => [
                            'allow' => [],
                            'deny' => [],
                        ],
                        'region' => [
                            'allow' => [],
                            'deny' => [],
                        ],
                        'city' => [
                            'allow' => [],
                            'deny' => [],
                        ],
                        'os' => [
                            'allow' => [],
                            'deny' => [],
                        ],

                        'isp' => [
                            'allow' => [],
                            'deny' => [],
                        ],

                        'ip' => [
                            'allow' => [],
                            'deny' => [],
                        ],
                        'browser' => [
                            'allow' => [],
                            'deny' => [],
                        ],

                        'brand' => [
                            'allow' => [],
                            'deny' => [],
                        ],

                        'device_type' => [
                            'allow' => [],
                            'deny' => [],
                        ],
                        'connection' => [],
                        'block_proxy' => false,
                    ],
                ],
                'consider_personal_targeting_only' => false,
                'hosts_only' => false,
                'uniq_ip_only' => false,
                'reject_not_uniq_ip' => false,
            ]
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOffersListShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offers', [])
            ->willReturn(
                [
                    'status' => 1,
                    'offers' => static::$attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $offersProvider = new OffersProvider($transport);
        $offersProvider->offersList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOffersListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'q' => 'qui',
            'ids' => ['vel'],
            'int_id' => [492372319],
            'countries' => ['et'],
            'os' => ['est'],
            'categories' => ['asperiores'],
            'sort' => ['voluptas'],
            'page' => 2,
            'limit' => 6,
            'status' => ['iusto'],
            'advertiser' => ['expedita'],
            'privacy' => [512118736],
            'updated_at' => '2020-12-27T23:00:02+00:00',
            'is_top' => 1597283184,
            'bundle_id' => 'dolorem',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offers', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offersProvider = new OffersProvider($transport);
        $offersProvider->offersList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOffersListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offers')
            ->willReturn(
                [
                    'status' => 1,
                    'offers' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $offersProvider = new OffersProvider($transport);
        $response = $offersProvider->offersList();

        $expectedData = array_map(fn(array $a) => new OffersListDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOffersListWithPartnerResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$partnerAttributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offers')
            ->willReturn(
                [
                    'status' => 1,
                    'offers' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $offersProvider = new OffersProvider($transport);
        $response = $offersProvider->offersList();

        $expectedData = array_map(fn(array $a) => new OffersListPartnerDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
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
    public function testOffersListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $offersProvider = new OffersProvider($transport);

        $this->expectException($exceptionClass);

        $offersProvider->offersList();
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
