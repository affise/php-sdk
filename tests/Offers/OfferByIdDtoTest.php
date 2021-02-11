<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class OfferByIdDtoTest
 */
class OfferByIdDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 906,
            'offer_id' => '5721f8e03b7d9b7f058b4568',
            'advertiser' => '56cc49dc3b7d9b89058b45f0',
            'external_offer_id' => '56cc49dc3b7d9b89058b45f0',
            'bundle_id' => '46cc97dc3b7d9b10758b45f0',
            'hide_payments' => false,
            'title' => '',
            'macro_url' => '',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'http://affise.com',
            'trafficback_url' => 'http://affise.com',
            'url_preview' => 'ipsa',
            'preview_url' => 'fugiat',
            'domain_url' => 'qui',
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
            'logo' => 'a',
            'logo_source' => 'et',
            'status' => 'active',
            'tags' => [],
            'notes' => 'test',
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
                    'title' => 'Dr.',
                    'type' => 'fixed',
                    'country_exclude' => false,
                    'with_regions' => false,

                ],
            ],
            'hide_caps' => 0,
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
            'strictly_os' => [],
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
            'required_approval' => false,
            'is_cpi' => false,
            'kpi' => ['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''],
            'sub_restrictions' => [],
            'creatives' => [],
            'sub_accounts' => [['value' => '', 'except' => false], ['value' => '', 'except' => false]],
            'redirect_type' => 'http302',
            'reject_not_unique_ip' => false,
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
            'schedule' => [
                'enabled' => false,
                'date_start' => '',
                'date_to' => '',
                'timezone' => 'Europe\Moscow',
            ],
        ];
    }

    public function testGetId(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(906, $offerByIdDto->getId());
    }

    public function testGetOfferId(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('5721f8e03b7d9b7f058b4568', $offerByIdDto->getOfferId());
    }

    public function testGetAdvertiser(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('56cc49dc3b7d9b89058b45f0', $offerByIdDto->getAdvertiser());
    }

    public function testGetExternalOfferId(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('56cc49dc3b7d9b89058b45f0', $offerByIdDto->getExternalOfferId());
    }

    public function testGetBundleId(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('46cc97dc3b7d9b10758b45f0', $offerByIdDto->getBundleId());
    }

    public function testGetHidePayments(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdDto->getHidePayments());
    }

    public function testGetTitle(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('', $offerByIdDto->getTitle());
    }

    public function testGetMacroUrl(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('', $offerByIdDto->getMacroUrl());
    }

    public function testGetUrl(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $offerByIdDto->getUrl());
    }

    public function testGetCrossPostbackUrl(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $offerByIdDto->getCrossPostbackUrl());
    }

    public function testGetUrlPreview(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('ipsa', $offerByIdDto->getUrlPreview());
    }

    public function testGetPreviewUrl(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('fugiat', $offerByIdDto->getPreviewUrl());
    }

    public function testGetDomainUrl(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('qui', $offerByIdDto->getDomainUrl());
    }

    public function testGetUseHttps(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(true, $offerByIdDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(true, $offerByIdDto->getUseHttp());
    }

    public function testGetDescriptionLang(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            ['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''],
            $offerByIdDto->getDescriptionLang()
        );
    }

    public function testGetSources(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            [
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
            $offerByIdDto->getSources()
        );
    }

    public function testGetLogo(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('a', $offerByIdDto->getLogo());
    }

    public function testGetStatus(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('active', $offerByIdDto->getStatus());
    }

    public function testGetTags(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getTags());
    }

    public function testGetPrivacy(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('public', $offerByIdDto->getPrivacy());
    }

    public function testGetIsTop(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerByIdDto->getIsTop());
    }

    public function testGetPayments(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new PaymentDto(
                    [
                        'countries' => [],
                        'cities' => [],
                        'devices' => [],
                        'os' => ['Mac OS X'],
                        'goal' => '1',
                        'total' => 1020,
                        'revenue' => 800,
                        'currency' => 'rub',
                        'title' => 'Dr.',
                        'type' => 'fixed',
                        'country_exclude' => false,
                        'with_regions' => false,
                    ]
                ),
            ],
            $offerByIdDto->getPayments()
        );
    }

    public function testGetHideCaps(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerByIdDto->getHideCaps());
    }

    public function testGetPartnerPayments(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new PartnerPaymentDto(
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
                    ]
                ),
            ],
            $offerByIdDto->getPartnerPayments()
        );
    }

    public function testGetLandings(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getLandings());
    }

    public function testGetStrictlyCountry(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['strictly_country' => 0]);
        $this->assertEquals(0, $offerByIdDto->getStrictlyCountry());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['strictly_country' => null]);
        $this->assertNull($offerByIdDto->getStrictlyCountry());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getStrictlyOs());
    }

    public function testGetStrictlyConnectionType(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['strictly_connection_type' => 'test']);
        $this->assertEquals('test', $offerByIdDto->getStrictlyConnectionType());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['strictly_connection_type' => null]);
        $this->assertNull($offerByIdDto->getStrictlyConnectionType());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getStrictlyConnectionType());
    }

    public function testGetIsRedirectOvercap(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdDto->getIsRedirectOvercap());
    }

    public function testGetNoticePercentOvercap(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerByIdDto->getNoticePercentOvercap());
    }

    public function testGetHoldPeriod(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerByIdDto->getHoldPeriod());
    }

    public function testGetCategories(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getFullCategories());
    }

    public function testGetCr(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(1.21, $offerByIdDto->getCr());
    }

    public function testGetEpc(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(9.58, $offerByIdDto->getEpc());
    }

    public function testGetAllowedIp(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('', $offerByIdDto->getAllowedIp());
    }

    public function testGetDisallowedIp(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('', $offerByIdDto->getDisallowedIp());
    }

    public function testGetHashPassword(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('', $offerByIdDto->getHashPassword());
    }

    public function testGetAllowDeeplink(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerByIdDto->getAllowDeeplink());
    }

    public function testGetHideReferer(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['hide_referer' => false]);
        $this->assertEquals(0, $offerByIdDto->getHideReferer());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['hide_referer' => null]);
        $this->assertNull($offerByIdDto->getHideReferer());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getHideReferer());
    }

    public function testGetStartAt(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['start_at' => '2018-11-05 12:35:00']);
        $this->assertEquals('2018-11-05 12:35:00', $offerByIdDto->getStartAt());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['start_at' => null]);
        $this->assertNull($offerByIdDto->getStartAt());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getStartAt());
    }

    public function testGetRequiredApproval(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdDto->getRequiredApproval());
    }

    public function testGetIsCpi(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdDto->getIsCpi());
    }

    public function testGetKpi(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''], $offerByIdDto->getKpi());
    }

    public function testGetSubRestrictions(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getSubRestrictions());
    }

    public function testGetCreatives(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getCreatives());
    }

    public function testGetSubAccounts(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            [['value' => '', 'except' => false], ['value' => '', 'except' => false]],
            $offerByIdDto->getSubAccounts()
        );
    }

    public function testGetRedirectType(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('http302', $offerByIdDto->getRedirectType());
    }

    public function testGetCaps(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CapDto(
                    [
                        'period' => 'day',
                        'type' => 'conversions',
                        'value' => 100,
                        'goal_type' => 'exact',
                        'goals' => ['Install', 'Register'],
                        'affiliate_type' => 'exact',
                        'affiliates' => [500, 600],
                        'country_type' => 'all',
                    ]
                ),
            ],
            $offerByIdDto->getCaps()
        );
    }

    public function testGetCommissionTiers(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CommissionTierDto(
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
                    ]
                ),
            ],
            $offerByIdDto->getCommissionTiers()
        );
    }

    public function testGetCapsTimezone(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('Europe/Moscow', $offerByIdDto->getCapsTimezone());
    }

    public function testGetStrictlyIsp(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getStrictlyIsp());
    }

    public function testGetRestrictionIsp(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getRestrictionIsp());
    }

    public function testGetStrictlyDevices(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getStrictlyDevices());
    }

    public function testGetDisabledChoicePostbackStatus(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdDto->getDisabledChoicePostbackStatus());
    }

    public function testGetUpdatedAt(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('2019-01-07 11:41:52', $offerByIdDto->getUpdatedAt());
    }

    public function testGetCreatedAt(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('2019-01-05 11:08:31', $offerByIdDto->getCreatedAt());
    }

    public function testGetAllowImpressions(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdDto->getAllowImpressions());
    }

    public function testGetSmartlinkCategories(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdDto->getSmartlinkCategories());
    }

    public function testGetClickSession(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('1y', $offerByIdDto->getClickSession());
    }

    public function testGetUniqIpOnly(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdDto->getUniqIpOnly());
    }

    public function testGetRejectNotUniqIp(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['reject_not_uniq_ip' => false]);
        $this->assertEquals(false, $offerByIdDto->getRejectNotUniqIp());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['reject_not_uniq_ip' => null]);
        $this->assertNull($offerByIdDto->getRejectNotUniqIp());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getRejectNotUniqIp());
    }

    public function testGetLogoSource(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('et', $offerByIdDto->getLogoSource());
    }

    public function testGetStrictlyBrands(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['strictly_brands' => ['nostrum']]);
        $this->assertEquals(['nostrum'], $offerByIdDto->getStrictlyBrands());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['strictly_brands' => null]);
        $this->assertEmpty($offerByIdDto->getStrictlyBrands());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertEmpty($offerByIdDto->getStrictlyBrands());
    }

    public function testGetNotes(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals('test', $offerByIdDto->getNotes());
    }

    public function testGetStopAt(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['stop_at' => '2020-12-27T13:26:16+00:00']);
        $this->assertEquals('2020-12-27T13:26:16+00:00', $offerByIdDto->getStopAt());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['stop_at' => null]);
        $this->assertNull($offerByIdDto->getStopAt());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getStopAt());
    }

    public function testGetAutoOfferConnect(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['auto_offer_connect' => 1]);
        $this->assertEquals(1, $offerByIdDto->getAutoOfferConnect());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['auto_offer_connect' => null]);
        $this->assertNull($offerByIdDto->getAutoOfferConnect());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getAutoOfferConnect());
    }

    public function testGetCreativesZip(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['creatives_zip' => 'dolorem']);
        $this->assertEquals('dolorem', $offerByIdDto->getCreativesZip());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($offerByIdDto->getCreativesZip());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getCreativesZip());
    }

    public function testGetCapsStatus(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['caps_status' => ['confirmed']]);
        $this->assertEquals(['confirmed'], $offerByIdDto->getCapsStatus());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertEmpty($offerByIdDto->getCapsStatus());
    }

    public function testGetSearchEmptySub(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['search_empty_sub' => 'esse']);
        $this->assertEquals('esse', $offerByIdDto->getSearchEmptySub());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['search_empty_sub' => null]);
        $this->assertNull($offerByIdDto->getSearchEmptySub());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getSearchEmptySub());
    }

    public function testGetSchedule(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'enabled' => false,
                'date_start' => '',
                'date_to' => '',
                'timezone' => 'Europe\Moscow',
            ],
            $offerByIdDto->getSchedule()
        );
    }

    public function testGetMinimalClickSession(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['minimal_click_session' => 'officia']);
        $this->assertEquals('officia', $offerByIdDto->getMinimalClickSession());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['minimal_click_session' => null]);
        $this->assertNull($offerByIdDto->getMinimalClickSession());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getMinimalClickSession());
    }

    public function testGetIoDocument(): void
    {
        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['io_document' => 'fugit']);
        $this->assertEquals('fugit', $offerByIdDto->getIoDocument());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes + ['io_document' => null]);
        $this->assertNull($offerByIdDto->getIoDocument());

        $offerByIdDto = new OfferByIdDto(static::$requiredAttributes);
        $this->assertNull($offerByIdDto->getIoDocument());
    }
}
