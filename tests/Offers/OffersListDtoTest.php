<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class OffersListDtoTest
 */
class OffersListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 331,
            'offer_id' => '5bdffa7339f65625008b4568',
            'advertiser' => '5bc9d7c16d73e41c008b4567',
            'external_offer_id' => '',
            'bundle_id' => '',
            'hide_payments' => false,
            'title' => 'blabla',
            'macro_url' => '',
            'url' => '',
            'cross_postback_url' => 'magnam',
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
            'logo' => 'porro',
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
                    'revenue' => 500,
                    'currency' => 'usd',
                    'title' => 'goal1',
                    'type' => 'fixed',
                    'country_exclude' => false,
                    'total' => 1000,
                    'with_regions' => false,

                ],
            ],
            'partner_payments' => [],
            'landings' => [
                [
                    'id' => 1,
                    'title' => 'Prof.',
                    'url' => 'http://affise.com',
                    'url_preview' => 'eos',
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
            'cr' => 0.75,
            'epc' => 0.25,
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
        ];
    }

    public function testGetId(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(331, $offersListDto->getId());
    }

    public function testGetOfferId(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('5bdffa7339f65625008b4568', $offersListDto->getOfferId());
    }

    public function testGetAdvertiser(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('5bc9d7c16d73e41c008b4567', $offersListDto->getAdvertiser());
    }

    public function testGetExternalOfferId(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getExternalOfferId());
    }

    public function testGetBundleId(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getBundleId());
    }

    public function testGetHidePayments(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getHidePayments());
    }

    public function testGetTitle(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('blabla', $offersListDto->getTitle());
    }

    public function testGetMacroUrl(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getMacroUrl());
    }

    public function testGetUrl(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getUrl());
    }

    public function testGetCrossPostbackUrl(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('magnam', $offersListDto->getCrossPostbackUrl());
    }

    public function testGetUrlPreview(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getUrlPreview());
    }

    public function testGetPreviewUrl(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getPreviewUrl());
    }

    public function testGetDomainUrl(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getDomainUrl());
    }

    public function testGetTrafficbackUrl(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getTrafficbackUrl());
    }

    public function testGetUseHttps(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(true, $offersListDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(true, $offersListDto->getUseHttp());
    }

    public function testGetDescriptionLang(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => 'Описание', 'en' => 'Description'], $offersListDto->getDescriptionLang());
    }

    public function testGetSources(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new SourceDto(
                    [
                        'id' => '51f531f53b7d9b1e0382f6d9',
                        'title' => 'Web sites',
                        'allowed' => 1,
                    ]
                ),
            ],
            $offersListDto->getSources()
        );
    }

    public function testGetLogo(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('porro', $offersListDto->getLogo());
    }

    public function testGetLogoSource(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getLogoSource());
    }

    public function testGetStatus(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('active', $offersListDto->getStatus());
    }

    public function testGetTags(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getTags());
    }

    public function testGetPrivacy(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('public', $offersListDto->getPrivacy());
    }

    public function testGetIsTop(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(0, $offersListDto->getIsTop());
    }

    public function testGetPayments(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new PaymentDto(
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
                        'revenue' => 500,
                        'currency' => 'usd',
                        'title' => 'goal1',
                        'type' => 'fixed',
                        'country_exclude' => false,
                        'total' => 1000,
                        'with_regions' => false,
                    ]
                ),
            ],
            $offersListDto->getPayments()
        );
    }

    public function testGetPartnerPayments(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getPartnerPayments());
    }

    public function testGetLandings(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new LandingDto(
                    [
                        'id' => 1,
                        'title' => 'Prof.',
                        'url' => 'http://affise.com',
                        'url_preview' => 'eos',
                        'type' => 'landing',
                    ]
                ),
            ],
            $offersListDto->getLandings()
        );
    }

    public function testGetStrictlyCountry(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(0, $offersListDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getStrictlyOs());
    }

    public function testGetStrictlyBrands(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getStrictlyBrands());
    }

    public function testGetTargeting(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new TargetingDto(
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
                    ]
                ),
            ],
            $offersListDto->getTargeting()
        );
    }

    public function testGetIsRedirectOvercap(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getIsRedirectOvercap());
    }

    public function testGetNoticePercentOvercap(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(0, $offersListDto->getNoticePercentOvercap());
    }

    public function testGetHoldPeriod(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(0, $offersListDto->getHoldPeriod());
    }

    public function testGetCategories(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(['...', '...'], $offersListDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new FullCategoryDto(['id' => '5368afb23b7d9b4d5d505342', 'title' => '...']),
                new FullCategoryDto(['id' => '55b204663b7d9b460b8b45b2', 'title' => '...']),
            ],
            $offersListDto->getFullCategories()
        );
    }

    public function testGetCr(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(0.75, $offersListDto->getCr());
    }

    public function testGetEpc(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(0.25, $offersListDto->getEpc());
    }

    public function testGetNotes(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getNotes());
    }

    public function testGetAllowedIp(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getAllowedIp());
    }

    public function testGetDisallowedIp(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getDisallowedIp());
    }

    public function testGetHashPassword(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getHashPassword());
    }

    public function testGetAllowDeeplink(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getAllowDeeplink());
    }

    public function testGetHideReferer(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getHideReferer());
    }

    public function testGetStartAt(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('2018-11-06 12:35:00', $offersListDto->getStartAt());
    }

    public function testGetStopAt(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getStopAt());
    }

    public function testGetAutoOfferConnect(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(0, $offersListDto->getAutoOfferConnect());
    }

    public function testGetRequiredApproval(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getRequiredApproval());
    }

    public function testGetIsCpi(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getIsCpi());
    }

    public function testGetCreatives(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getCreatives());
    }

    public function testGetCreatedAt(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('2018-11-05 11:08:19', $offersListDto->getCreatedAt());
    }

    public function testGetSubAccounts(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(
            [['value' => '', 'except' => false], ['value' => '', 'except' => false]],
            $offersListDto->getSubAccounts()
        );
    }

    public function testGetKpi(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''], $offersListDto->getKpi());
    }

    public function testGetStrictlyIsp(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getStrictlyIsp());
    }

    public function testGetCaps(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CapDto(
                    [
                        'period' => 'day',
                        'type' => 'conversions',
                        'value' => 100,
                        'goal_type' => 'exact',
                        'goals' => ['Install'],
                        'affiliate_type' => 'exact',
                        'affiliates' => [500, 600],
                        'country_type' => 'all',
                    ]
                ),
            ],
            $offersListDto->getCaps()
        );
    }

    public function testGetCommissionTiers(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

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
            $offersListDto->getCommissionTiers()
        );
    }

    public function testGetUpdatedAt(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals('2019-02-08 10:03:38', $offersListDto->getUpdatedAt());
    }

    public function testGetAllowImpressions(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getAllowImpressions());
    }

    public function testGetSmartlinkCategories(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getSmartlinkCategories());
    }

    public function testGetUniqIpOnly(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getUniqIpOnly());
    }

    public function testGetRejectNotUniqIp(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getRejectNotUniqIp());
    }

    public function testGetStrictlyConnectionType(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes + ['strictly_connection_type' => 'illo']);
        $this->assertEquals('illo', $offersListDto->getStrictlyConnectionType());

        $offersListDto = new OffersListDto(static::$requiredAttributes + ['strictly_connection_type' => null]);
        $this->assertNull($offersListDto->getStrictlyConnectionType());

        $offersListDto = new OffersListDto(static::$requiredAttributes);
        $this->assertNull($offersListDto->getStrictlyConnectionType());
    }

    public function testGetRestrictionIsp(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes + ['restriction_isp' => ['laboriosam']]);
        $this->assertEquals(['laboriosam'], $offersListDto->getRestrictionIsp());

        $offersListDto = new OffersListDto(static::$requiredAttributes + ['restriction_isp' => null]);
        $this->assertNull($offersListDto->getRestrictionIsp());

        $offersListDto = new OffersListDto(static::$requiredAttributes);
        $this->assertNull($offersListDto->getRestrictionIsp());
    }

    public function testGetCreativesZip(): void
    {
        $offersListDto = new OffersListDto(static::$requiredAttributes + ['creatives_zip' => 'quo']);
        $this->assertEquals('quo', $offersListDto->getCreativesZip());

        $offersListDto = new OffersListDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($offersListDto->getCreativesZip());

        $offersListDto = new OffersListDto(static::$requiredAttributes);
        $this->assertNull($offersListDto->getCreativesZip());
    }
}
