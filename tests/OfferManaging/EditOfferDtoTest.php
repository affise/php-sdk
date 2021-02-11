<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class EditOfferDtoTest
 */
class EditOfferDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 936,
            'offer_id' => '5943f7307e28fe9a1f8b456d',
            'advertiser' => '573c69a33b7d9b0e638b4576',
            'hide_payments' => false,
            'title' => 'test_edit',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'sit',
            'url_preview' => 'odio',
            'preview_url' => 'est',
            'domain_url' => 'quia',
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

    public function testGetId(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(936, $editOfferDto->getId());
    }

    public function testGetOfferId(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('5943f7307e28fe9a1f8b456d', $editOfferDto->getOfferId());
    }

    public function testGetAdvertiser(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('573c69a33b7d9b0e638b4576', $editOfferDto->getAdvertiser());
    }

    public function testGetHidePayments(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $editOfferDto->getHidePayments());
    }

    public function testGetTitle(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('test_edit', $editOfferDto->getTitle());
    }

    public function testGetUrl(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $editOfferDto->getUrl());
    }

    public function testGetCrossPostbackUrl(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('sit', $editOfferDto->getCrossPostbackUrl());
    }

    public function testGetUrlPreview(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('odio', $editOfferDto->getUrlPreview());
    }

    public function testGetPreviewUrl(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('est', $editOfferDto->getPreviewUrl());
    }

    public function testGetDomainUrl(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('quia', $editOfferDto->getDomainUrl());
    }

    public function testGetUseHttps(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $editOfferDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(true, $editOfferDto->getUseHttp());
    }

    public function testGetDescriptionLang(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => 'Описание', 'en' => 'Description'], $editOfferDto->getDescriptionLang());
    }

    public function testGetSources(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getSources());
    }

    public function testGetLogo(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('/images/cpa/logos/', $editOfferDto->getLogo());
    }

    public function testGetStatus(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('stopped', $editOfferDto->getStatus());
    }

    public function testGetTags(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(['default'], $editOfferDto->getTags());
    }

    public function testGetPrivacy(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('public', $editOfferDto->getPrivacy());
    }

    public function testGetIsTop(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getIsTop());
    }

    public function testGetPayments(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getPayments());
    }

    public function testGetPartnerPayments(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getPartnerPayments());
    }

    public function testGetLandings(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getLandings());
    }

    public function testGetStrictlyCountry(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getStrictlyOs());
    }

    public function testGetStrictlyConnectionType(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('wi-fi', $editOfferDto->getStrictlyConnectionType());
    }

    public function testGetIsRedirectOvercap(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $editOfferDto->getIsRedirectOvercap());
    }

    public function testGetHoldPeriod(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getHoldPeriod());
    }

    public function testGetCategories(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getFullCategories());
    }

    public function testGetCr(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getCr());
    }

    public function testGetEpc(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getEpc());
    }

    public function testGetAllowedIp(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('', $editOfferDto->getAllowedIp());
    }

    public function testGetAllowDeeplink(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getAllowDeeplink());
    }

    public function testGetHideReferer(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getHideReferer());
    }

    public function testGetStartAt(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('2017-06-17 12:35:00', $editOfferDto->getStartAt());
    }

    public function testGetRequiredApproval(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $editOfferDto->getRequiredApproval());
    }

    public function testGetIsCpi(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $editOfferDto->getIsCpi());
    }

    public function testGetCreatives(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $editOfferDto->getCreatives());
    }

    public function testGetSmartlinkCategories(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(['595e3b5b7e28fede7b8b456d'], $editOfferDto->getSmartlinkCategories());
    }

    public function testGetClickSession(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('1y', $editOfferDto->getClickSession());
    }

    public function testGetMinimalClickSession(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('0s', $editOfferDto->getMinimalClickSession());
    }

    public function testGetSubRestrictions(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals([['sub1' => 'sub_value1', 'sub2' => 'sub_value2']], $editOfferDto->getSubRestrictions());
    }

    public function testGetCapsTimezone(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('Europe/Moscow', $editOfferDto->getCapsTimezone());
    }

    public function testGetStrictlyIsp(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(['595e3b5b7e28fede7b8b456d'], $editOfferDto->getStrictlyIsp());
    }

    public function testGetHideCaps(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $editOfferDto->getHideCaps());
    }

    public function testGetCapsStatus(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(['confirmed'], $editOfferDto->getCapsStatus());
    }

    public function testGetCapsGoalOvercap(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals('install', $editOfferDto->getCapsGoalOvercap());
    }

    public function testGetCommissionTiers(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

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
            $editOfferDto->getCommissionTiers()
        );
    }

    public function testIsConsiderPersonalTargetingOnly(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $editOfferDto->getConsiderPersonalTargetingOnly());
    }

    public function testGetMacroUrl(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['macro_url' => 'placeat']);
        $this->assertEquals('placeat', $editOfferDto->getMacroUrl());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['macro_url' => null]);
        $this->assertNull($editOfferDto->getMacroUrl());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes);
        $this->assertNull($editOfferDto->getMacroUrl());
    }

    public function testGetNoticePercentOvercap(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['notice_percent_overcap' => 'nihil']);
        $this->assertEquals('nihil', $editOfferDto->getNoticePercentOvercap());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['notice_percent_overcap' => null]);
        $this->assertNull($editOfferDto->getNoticePercentOvercap());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes);
        $this->assertNull($editOfferDto->getNoticePercentOvercap());
    }

    public function testGetNotes(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['notes' => 'reiciendis']);
        $this->assertEquals('reiciendis', $editOfferDto->getNotes());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['notes' => null]);
        $this->assertNull($editOfferDto->getNotes());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes);
        $this->assertNull($editOfferDto->getNotes());
    }

    public function testGetHashPassword(): void
    {
        $editOfferDto = new EditOfferDto(
            static::$requiredAttributes + ['hash_password' => 'ae5e0c89a7147894619d612fcb33372431443c4e']
        );
        $this->assertEquals('ae5e0c89a7147894619d612fcb33372431443c4e', $editOfferDto->getHashPassword());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['hash_password' => null]);
        $this->assertNull($editOfferDto->getHashPassword());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes);
        $this->assertNull($editOfferDto->getHashPassword());
    }

    public function testGetStopAt(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['stop_at' => '2020-12-27T21:44:19+00:00']);
        $this->assertEquals('2020-12-27T21:44:19+00:00', $editOfferDto->getStopAt());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['stop_at' => null]);
        $this->assertNull($editOfferDto->getStopAt());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes);
        $this->assertNull($editOfferDto->getStopAt());
    }

    public function testGetAutoOfferConnect(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['auto_offer_connect' => 'voluptatem']);
        $this->assertEquals('voluptatem', $editOfferDto->getAutoOfferConnect());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['auto_offer_connect' => null]);
        $this->assertNull($editOfferDto->getAutoOfferConnect());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes);
        $this->assertNull($editOfferDto->getAutoOfferConnect());
    }

    public function testGetCreativesZip(): void
    {
        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['creatives_zip' => 'illum']);
        $this->assertEquals('illum', $editOfferDto->getCreativesZip());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($editOfferDto->getCreativesZip());

        $editOfferDto = new EditOfferDto(static::$requiredAttributes);
        $this->assertNull($editOfferDto->getCreativesZip());
    }
}
