<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\File;
use Affise\Sdk\Transport\TransportInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class AddOfferOfferManagingProviderTest
 */
class AddOfferOfferManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => 936,
            'offer_id' => '5943f7307e28fe9a1f8b456d',
            'advertiser' => '573c69a33b7d9b0e638b4576',
            'hide_payments' => false,
            'title' => 'test',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'illo',
            'url_preview' => 'quibusdam',
            'preview_url' => 'quos',
            'domain_url' => 'qui',
            'use_https' => false,
            'use_http' => true,
            'description_lang' => ['ru' => 'Описание', 'en' => 'Description'],
            'sources' => [],
            'logo' => '/images/cpa/logos/',
            'status' => 'stopped',
            'tags' => ['default'],
            'privacy' => 'public',
            'is_top' => 0,
            'payments' => [],
            'partner_payments' => [],
            'landings' => [],
            'strictly_country' => 0,
            'strictly_os' => [],
            'strictly_connection_type' => 'wi-fi',
            'is_redirect_overcap' => false,
            'hold_period' => 0,
            'categories' => [],
            'full_categories' => [],
            'cr' => 0,
            'epc' => 0,
            'allowed_ip' => '',
            'allow_deeplink' => 0,
            'hide_referer' => 0,
            'start_at' => '2017-06-17 12:35:00',
            'required_approval' => false,
            'is_cpi' => false,
            'creatives' => [],
            'smartlink_categories' => ['595e3b5b7e28fede7b8b456d'],
            'click_session' => '1y',
            'minimal_click_session' => '0s',
            'external_offer_id' => '5a97f4af94b814997c8b456a',
            'bundle_id' => '5jfj7jjs0amcslsaaah',
            'sub_restrictions' => [['sub1' => 'sub_value1', 'sub2' => 'sub_value2']],
            'caps_timezone' => 'Europe/Moscow',
            'strictly_isp' => ['595e3b5b7e28fede7b8b456d'],
            'note_aff' => '',
            'note_sales' => '',
            'disallowed_ip' => '',
            'hide_caps' => 0,
            'caps_status' => ['confirmed'],
            'caps_goal_overcap' => 'install',
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
            'consider_personal_targeting_only' => false,
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testAddOfferFailsWhenFiltersAreNotSet(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $offerManagingProvider->addOffer([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddOfferWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'title' => 'Ms.',
            'advertiser' => 'eos',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'pariatur',
            'macro_url' => 'veritatis',
            'url_preview' => 'dolores',
            'trafficback_url' => 'sed',
            'domain_url' => 1576946656,
            'description_lang' => 'non',
            'stopDate' => 'aut',
            'creativeFiles' => [File::createFromResource(tmpfile(), 'application/octet-stream')],
            'creativeUrls' => 'quis',
            'creativeDownloads' => 'soluta',
            'sources' => 'voluptates',
            'logo' => 'ut',
            'status' => 'cum',
            'tags' => 'sunt',
            'privacy' => 'incidunt',
            'is_top' => 982987445,
            'is_cpi' => 975563006,
            'payments' => 'tempore',
            'partner_payments' => 'maxime',
            'notice_percent_overcap' => 1807236822,
            'landings' => 'similique',
            'strictly_country' => 1829453858,
            'strictly_connection_type' => 'voluptatibus',
            'strictly_os' => 'velit',
            'restriction_os' => 'non',
            'strictly_devices' => 'nihil',
            'caps' => [['caps' => [877118406, 669035728]]],
            'strictly_brands' => 'officia',
            'caps_status' => 'aut',
            'caps_timezone' => 'occaecati',
            'commission_tiers' => [['commission_tiers' => [1143714857]]],
            'enabled_commission_tiers' => 1115158568,
            'hold_period' => 1935711557,
            'categories' => 'eveniet',
            'notes' => 'maiores',
            'allowed_ip' => '20.38.138.202',
            'allow_deeplink' => 588990021,
            'hide_referer' => 912788174,
            'redirect_type' => 'voluptate',
            'start_at' => '2020-12-27T20:17:15+00:00',
            'send_emails' => 1617341592,
            'is_redirect_overcap' => 810154888,
            'hide_payments' => 62043139,
            'click_session' => 'vel',
            'minimal_click_session' => 'dolores',
            'sub_account_1' => 'voluptatem',
            'sub_account_2' => 'aperiam',
            'sub_account_1_except' => 268288654,
            'sub_account_2_except' => 340267652,
            'smartlink_categories' => 'in',
            'kpi' => 'maxime',
            'sub_restrictions' => [['sub_restrictions' => 'dolorem']],
            'uniqIpOnly' => 1187919196,
            'rejectNotUniqIp' => 2128296199,
            'strictly_isp' => 'soluta',
            'restriction_isp' => 'quidem',
            'external_offer_id' => 'a',
            'bundle_id' => 'non',
            'note_aff' => 'sequi',
            'note_sales' => 'debitis',
            'disallowed_ip' => '137.168.160.206',
            'hide_caps' => 320967729,
            'search_empty_sub' => 318570987,
            'caps_goal_overcap' => 'tenetur',
            'targeting' => [['targeting' => false]],
            'allow_impressions' => 734060428,
            'impressions_url' => 'pariatur',
            'consider_personal_targeting_only' => 'iusto',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->addOffer($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddOfferFailsWhenTitleIsNotPassed(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'title' is required");

        $offerManagingProvider->addOffer(
            [
                'advertiser' => 'eos',
                'url' => 'http://affise.com',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddOfferFailsWhenAdvertiserIsNotPassed(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'advertiser' is required");

        $offerManagingProvider->addOffer(
            [
                'title' => 'Ms.',
                'url' => 'http://affise.com',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddOfferFailsWhenUrlIsNotPassed(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'url' is required");

        $offerManagingProvider->addOffer(
            [
                'title' => 'Ms.',
                'advertiser' => 'eos',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddOfferContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'title' => 'Ms.',
            'advertiser' => 'eos',
            'url' => 'http://affise.com',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer', $data, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->addOffer($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddOfferResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer')
            ->willReturn(
                [
                    'status' => 1,
                    'offer' => $attributes,
                    'id' => 936,
                ]
            );

        $offerManagingProvider = new OfferManagingProvider($transport);
        $response = $offerManagingProvider->addOffer(
            [
                'title' => 'Ms.',
                'advertiser' => 'eos',
                'url' => 'http://affise.com',
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(AddOfferDto::class, $response->getData());
        $this->assertEquals(new AddOfferDto($attributes), $response->getData());
        $this->assertEquals(936, $response->getId());
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
    public function testAddOfferFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $offerManagingProvider = new OfferManagingProvider($transport);

        $this->expectException($exceptionClass);

        $offerManagingProvider->addOffer(
            [
                'title' => 'Ms.',
                'advertiser' => 'eos',
                'url' => 'http://affise.com',
            ]
        );
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
