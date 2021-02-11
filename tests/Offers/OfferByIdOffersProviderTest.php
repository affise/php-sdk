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
 * Class OfferByIdOffersProviderTest
 */
class OfferByIdOffersProviderTest extends TestCase
{
    private static array $attributes;
    private static array $partnerAttributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => 906,
            'offer_id' => '5721f8e03b7d9b7f058b4568',
            'advertiser' => '56cc49dc3b7d9b89058b45f0',
            'external_offer_id' => '46cc97dc3b7d9b10758b45f0',
            'bundle_id' => '46cc97dc3b7d9b10758b45f0',
            'hide_payments' => false,
            'title' => '',
            'macro_url' => '',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'http://affise.com',
            'trafficback_url' => 'http://affise.com',
            'url_preview' => 'eum',
            'preview_url' => 'enim',
            'domain_url' => 'eius',
            'notes' => 'test',
            'use_https' => true,
            'use_http' => true,
            'description_lang' => ['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''],
            'sources' => [
                '51f531f53b7d9b1e0382f6d9',
                '51f532053b7d9b340eea741a',
                '51f532103b7d9b340e325f1c',
                '51f5322d3b7d9b340eabb872',
                '51f532393b7d9b5e030908a0',
                '51f5325e3b7d9b340e8a2b79',
                '51f532713b7d9b5e03b24520',
                '51f532873b7d9b5e03e88a74',
                '5432ffe43b7d9b615f4f7f2a',
                '5432fff93b7d9b615fab559d',
            ],
            'logo' => 'dolores',
            'logo_source' => 'test',
            'status' => 'active',
            'tags' => [],
            'privacy' => 'public',
            'is_top' => 0,
            'payments' => [
                [
                    'countries' => [],
                    'cities' => [],
                    'devices' => [],
                    'os' => ['Mac OS X'],
                    'goal' => '1',
                    'total' => 1020,
                    'revenue' => 800,
                    'currency' => 'rub',
                    'title' => 'Mr.',
                    'type' => 'fixed',
                    'country_exclude' => false,
                    'with_regions' => false,

                ],
            ],
            'partner_payments' => [
                [
                    'countries' => [],
                    'cities' => [],
                    'devices' => [],
                    'os' => [],
                    'goal' => '2',
                    'total' => 1600,
                    'revenue' => 900,
                    'currency' => 'usd',
                    'title' => 'Dr.',
                    'type' => 'fixed',
                    'country_exclude' => false,
                    'with_regions' => false,
                    'partners' => [610],

                ],
            ],
            'landings' => [],
            'strictly_country' => 0,
            'strictly_os' => [],
            'strictly_connection_type' => '',
            'is_redirect_overcap' => false,
            'notice_percent_overcap' => 0,
            'hold_period' => 0,
            'categories' => [],
            'full_categories' => [],
            'cr' => 1.21,
            'epc' => 9.58,
            'allowed_ip' => '',
            'disallowed_ip' => '',
            'hash_password' => '',
            'allow_deeplink' => 0,
            'hide_referer' => false,
            'hide_caps' => 0,
            'start_at' => '2018-11-05 12:35:00',
            'required_approval' => false,
            'is_cpi' => false,
            'kpi' => ['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''],
            'sub_restrictions' => [],
            'creatives' => [],
            'sub_accounts' => [['value' => '', 'except' => false], ['value' => '', 'except' => false]],
            'redirect_type' => 'http302',
            'caps' => [
                [
                    'period' => 'day',
                    'type' => 'conversions',
                    'value' => 100,
                    'goal_type' => 'exact',
                    'goals' => ['Install', 'Register'],
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
            'caps_timezone' => 'Europe/Moscow',
            'strictly_isp' => [],
            'restriction_isp' => [],
            'strictly_devices' => [],
            'disabled_choice_postback_status' => false,
            'updated_at' => '2019-01-07 11:41:52',
            'created_at' => '2019-01-05 11:08:31',
            'allow_impressions' => false,
            'smartlink_categories' => [],
            'click_session' => '1y',
            'uniq_ip_only' => false,
            'reject_not_uniq_ip' => false,
            'reject_not_unique_ip' => false,
        ];

        static::$partnerAttributes = [
            'id' => 11,
            'offer_id' => '5f05f2f5134ed05c008b4568',
            'title' => 'Mr.',
            'preview_url' => 'http://affise.com',
            'description_lang' => [
                'ru' => '<p>This offer requires approval from your AM</p>',
                'en' => '<p>This offer requires approval from your AM</p>',
                'cn' => '',
                'es' => '',
                'ka' => '',
                'vi' => '',
                'my' => '',
                'pt' => '',
            ],
            'logo' => 'est',
            'logo_source' => 'fugiat',
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
                ['id' => '5f1845f9134ed050008b4568', 'title' => 'Dating Adult']
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
            'caps' => [
                [
                    'goals' => [],
                    'period' => 'day',
                    'type' => 'conversions',
                    'value' => 100,
                    'goal_type' => 'all',
                    'country_type' => 'all',
                    'country' => [],
                ],
            ],
            'required_approval' => true,
            'strictly_country' => 0,
            'strictly_os' => [],
            'strictly_brands' => [],
            'is_cpi' => false,
            'creatives' => [],
            'landings' => [
                [
                    'id' => 1599727659,
                    'title' => 'Greymobile *Responsive tour, will look different on a mobile device',
                    'url' => 'http://affise.com',
                    'url_preview' => 'http://affise.com',
                    'type' => 'landing',
                ],
            ],
            'links' => [
                [
                    'url' => 'http://affise.com',
                    'postbacks' => [],
                ],
            ],
            'link' => 'est',
            'use_https' => true,
            'use_http' => false,
            'hold_period' => 0,
            'kpi' => [
                'en' => '<p>Not fans of pop traffic, if so please use prelanders</p>',
            ],
            'click_session' => '1y',
            'minimal_click_session' => '0s',
            'strictly_isp' => [],
            'restriction_isp' => [],
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
                    'block_proxy' => false,
                ],
            ],
            'consider_personal_targeting_only' => false,
            'hosts_only' => false,
            'uniq_ip_only' => false,
            'reject_not_uniq_ip' => false,
            'caps_timezone' => 'Europe/Moscow',
            'disabled_choice_postback_status' => false,
            'ticket_created' => false,
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOfferByIdShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offer/906')
            ->willReturn(
                [
                    'status' => 1,
                    'offer' => static::$attributes,
                ]
            );

        $offersProvider = new OffersProvider($transport);
        $offersProvider->offerById(906);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOfferByIdWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offer/906')
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offersProvider = new OffersProvider($transport);
        $offersProvider->offerById(906);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOfferByIdResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offer/906')
            ->willReturn(
                [
                    'status' => 1,
                    'offer' => $attributes,
                ]
            );

        $offersProvider = new OffersProvider($transport);
        $response = $offersProvider->offerById(906);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(OfferByIdDto::class, $response->getData());
        $this->assertEquals(new OfferByIdDto($attributes), $response->getData());
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOfferByIdWithPartnerResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$partnerAttributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/offer/906')
            ->willReturn(
                [
                    'status' => 1,
                    'offer' => $attributes,
                ]
            );

        $offersProvider = new OffersProvider($transport);
        $response = $offersProvider->offerById(906);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(OfferByIdPartnerDto::class, $response->getData());
        $this->assertEquals(new OfferByIdPartnerDto($attributes), $response->getData());
    }

    /**
     * @param string $exceptionClass
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
    public function testOfferByIdFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $offersProvider = new OffersProvider($transport);

        $this->expectException($exceptionClass);

        $offersProvider->offerById(906);
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
