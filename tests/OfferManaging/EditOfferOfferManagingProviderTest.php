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
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class EditOfferOfferManagingProviderTest
 */
class EditOfferOfferManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => 936,
            'offer_id' => '5943f7307e28fe9a1f8b456d',
            'advertiser' => '573c69a33b7d9b0e638b4576',
            'hide_payments' => false,
            'title' => 'test_edit',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'assumenda',
            'url_preview' => 'ad',
            'preview_url' => 'modi',
            'domain_url' => 'in',
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
            'sub_restrictions' => [['sub1' => 'sub_value1', 'sub2' => 'sub_value2']],
            'caps_timezone' => 'Europe/Moscow',
            'strictly_isp' => ['595e3b5b7e28fede7b8b456d'],
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
     */
    public function testEditOfferShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer/936', [])
            ->willReturn(
                [
                    'status' => 1,
                    'offer' => static::$attributes,
                    'id' => 936,
                ]
            );

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->editOffer(936, []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditOfferWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'title' => 'Dr.',
            'advertiser' => 'ea',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'exercitationem',
            'macro_url' => 'blanditiis',
            'url_preview' => 'numquam',
            'trafficback_url' => 'officiis',
            'domain_url' => 195025066,
            'description_lang' => 'voluptatum',
            'kpi' => 'beatae',
            'stopDate' => 'voluptas',
            'creativeFiles' => [File::createFromResource(tmpfile(), 'application/octet-stream')],
            'creativeUrls' => 'et',
            'creativeDownloads' => 'et',
            'sources' => 'sunt',
            'logo' => 'odit',
            'status' => 'voluptas',
            'tags' => 'fuga',
            'privacy' => 'repellendus',
            'is_top' => 1688027586,
            'is_cpi' => 319226722,
            'payments' => 'quia',
            'partner_payments' => 'vero',
            'notice_percent_overcap' => 1404473247,
            'landings' => 'quibusdam',
            'strictly_country' => 806523655,
            'strictly_connection_type' => 'deserunt',
            'strictly_os' => 'quia',
            'restriction_os' => 'minus',
            'strictly_devices' => 'consequatur',
            'caps' => [['caps' => ['vero', 'mollitia', 'sint']]],
            'caps_status' => 'aut',
            'caps_timezone' => 'ad',
            'commission_tiers' => [['commission_tiers' => [1473824148, 732334960, 1131226414]]],
            'enabled_commission_tiers' => 1402410528,
            'hold_period' => 486307449,
            'categories' => 'fugiat',
            'notes' => 'incidunt',
            'allowed_ip' => '59.162.96.126',
            'allow_deeplink' => 1049668068,
            'hide_referer' => 364522579,
            'redirect_type' => 'illum',
            'start_at' => '2020-12-27T23:02:05+00:00',
            'send_emails' => 340270519,
            'is_redirect_overcap' => 574244913,
            'hide_payments' => 648519651,
            'click_session' => 'laudantium',
            'minimal_click_session' => 'nemo',
            'sub_account_1' => 'adipisci',
            'sub_account_2' => 'alias',
            'sub_account_1_except' => 1268886984,
            'sub_account_2_except' => 1659299811,
            'smartlink_categories' => 'magnam',
            'sub_restrictions' => [['sub_restrictions' => 'repudiandae']],
            'uniqIpOnly' => 1163088509,
            'rejectNotUniqIp' => 746185878,
            'strictly_isp' => 'et',
            'restriction_isp' => 'tenetur',
            'external_offer_id' => 'tempore',
            'bundle_id' => 'ea',
            'hide_caps' => 1594559356,
            'search_empty_sub' => 1690934329,
            'caps_goal_overcap' => 'cumque',
            'targeting' => [['targeting' => [416359650, 515044061, 1776438615]]],
            'allow_impressions' => 575596376,
            'impressions_url' => 'sed',
            'consider_personal_targeting_only' => 'autem',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer/936', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->editOffer(936, $filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditOfferContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'title' => 'Dr.',
            'advertiser' => 'ea',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'exercitationem',
            'macro_url' => 'blanditiis',
            'url_preview' => 'numquam',
            'trafficback_url' => 'officiis',
            'domain_url' => 195025066,
            'description_lang' => 'voluptatum',
            'kpi' => 'beatae',
            'stopDate' => 'voluptas',
            'creativeFiles' => [File::createFromResource(tmpfile(), 'application/octet-stream')],
            'creativeUrls' => 'et',
            'creativeDownloads' => 'et',
            'sources' => 'sunt',
            'logo' => 'odit',
            'status' => 'voluptas',
            'tags' => 'fuga',
            'privacy' => 'repellendus',
            'is_top' => 1688027586,
            'is_cpi' => 319226722,
            'payments' => 'quia',
            'partner_payments' => 'vero',
            'notice_percent_overcap' => 1404473247,
            'landings' => 'quibusdam',
            'strictly_country' => 806523655,
            'strictly_connection_type' => 'deserunt',
            'strictly_os' => 'quia',
            'restriction_os' => 'minus',
            'strictly_devices' => 'consequatur',
            'caps' => [['caps' => ['vero', 'mollitia', 'sint']]],
            'caps_status' => 'aut',
            'caps_timezone' => 'ad',
            'commission_tiers' => [['commission_tiers' => [1473824148, 732334960, 1131226414]]],
            'enabled_commission_tiers' => 1402410528,
            'hold_period' => 486307449,
            'categories' => 'fugiat',
            'notes' => 'incidunt',
            'allowed_ip' => '59.162.96.126',
            'allow_deeplink' => 1049668068,
            'hide_referer' => 364522579,
            'redirect_type' => 'illum',
            'start_at' => '2020-12-27T23:02:05+00:00',
            'send_emails' => 340270519,
            'is_redirect_overcap' => 574244913,
            'hide_payments' => 648519651,
            'click_session' => 'laudantium',
            'minimal_click_session' => 'nemo',
            'sub_account_1' => 'adipisci',
            'sub_account_2' => 'alias',
            'sub_account_1_except' => 1268886984,
            'sub_account_2_except' => 1659299811,
            'smartlink_categories' => 'magnam',
            'sub_restrictions' => [['sub_restrictions' => 'repudiandae']],
            'uniqIpOnly' => 1163088509,
            'rejectNotUniqIp' => 746185878,
            'strictly_isp' => 'et',
            'restriction_isp' => 'tenetur',
            'external_offer_id' => 'tempore',
            'bundle_id' => 'ea',
            'hide_caps' => 1594559356,
            'search_empty_sub' => 1690934329,
            'caps_goal_overcap' => 'cumque',
            'targeting' => [['targeting' => [416359650, 515044061, 1776438615]]],
            'allow_impressions' => 575596376,
            'impressions_url' => 'sed',
            'consider_personal_targeting_only' => 'autem',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer/936', $filters, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->editOffer(936, $filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditOfferResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer/936')
            ->willReturn(
                [
                    'status' => 1,
                    'offer' => $attributes,
                    'id' => 936,
                ]
            );

        $offerManagingProvider = new OfferManagingProvider($transport);
        $response = $offerManagingProvider->editOffer(936);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(EditOfferDto::class, $response->getData());
        $this->assertEquals(new EditOfferDto($attributes), $response->getData());
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
    public function testEditOfferFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $offerManagingProvider = new OfferManagingProvider($transport);

        $this->expectException($exceptionClass);

        $offerManagingProvider->editOffer(936);
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
