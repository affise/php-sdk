<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
* Class AddOfferDtoTest
*/
class AddOfferDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 936,
            'offer_id' => '5943f7307e28fe9a1f8b456d',
            'advertiser' => '573c69a33b7d9b0e638b4576',
            'hide_payments' => false,
            'title' => 'test',
            'url' => 'http://affise.com',
            'cross_postback_url' => 'occaecati',
            'url_preview' => 'inventore',
            'preview_url' => 'optio',
            'domain_url' => 'eveniet',
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

    public function testGetId(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(936, $addOfferDto->getId());
    }

    public function testGetOfferId(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('5943f7307e28fe9a1f8b456d', $addOfferDto->getOfferId());
    }

    public function testGetAdvertiser(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('573c69a33b7d9b0e638b4576', $addOfferDto->getAdvertiser());
    }

    public function testGetHidePayments(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $addOfferDto->getHidePayments());
    }

    public function testGetTitle(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('test', $addOfferDto->getTitle());
    }

    public function testGetUrl(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $addOfferDto->getUrl());
    }

    public function testGetCrossPostbackUrl(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('occaecati', $addOfferDto->getCrossPostbackUrl());
    }

    public function testGetUrlPreview(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('inventore', $addOfferDto->getUrlPreview());
    }

    public function testGetPreviewUrl(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('optio', $addOfferDto->getPreviewUrl());
    }

    public function testGetDomainUrl(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('eveniet', $addOfferDto->getDomainUrl());
    }

    public function testGetUseHttps(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $addOfferDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(true, $addOfferDto->getUseHttp());
    }

    public function testGetDescriptionLang(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => 'Описание', 'en' => 'Description'], $addOfferDto->getDescriptionLang());
    }

    public function testGetSources(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getSources());
    }

    public function testGetLogo(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('/images/cpa/logos/', $addOfferDto->getLogo());
    }

    public function testGetStatus(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('stopped', $addOfferDto->getStatus());
    }

    public function testGetTags(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(['default'], $addOfferDto->getTags());
    }

    public function testGetPrivacy(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('public', $addOfferDto->getPrivacy());
    }

    public function testGetIsTop(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getIsTop());
    }

    public function testGetPayments(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getPayments());
    }

    public function testGetPartnerPayments(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getPartnerPayments());
    }

    public function testGetLandings(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getLandings());
    }

    public function testGetStrictlyCountry(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getStrictlyOs());
    }

    public function testGetStrictlyConnectionType(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('wi-fi', $addOfferDto->getStrictlyConnectionType());
    }

    public function testGetIsRedirectOvercap(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $addOfferDto->getIsRedirectOvercap());
    }

    public function testGetHoldPeriod(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getHoldPeriod());
    }

    public function testGetCategories(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getFullCategories());
    }

    public function testGetCr(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getCr());
    }

    public function testGetEpc(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getEpc());
    }

    public function testGetAllowedIp(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('', $addOfferDto->getAllowedIp());
    }

    public function testGetAllowDeeplink(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getAllowDeeplink());
    }

    public function testGetHideReferer(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getHideReferer());
    }

    public function testGetStartAt(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('2017-06-17 12:35:00', $addOfferDto->getStartAt());
    }

    public function testGetRequiredApproval(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $addOfferDto->getRequiredApproval());
    }

    public function testGetIsCpi(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $addOfferDto->getIsCpi());
    }

    public function testGetCreatives(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([], $addOfferDto->getCreatives());
    }

    public function testGetSmartlinkCategories(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(['595e3b5b7e28fede7b8b456d'], $addOfferDto->getSmartlinkCategories());
    }

    public function testGetClickSession(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('1y', $addOfferDto->getClickSession());
    }

    public function testGetMinimalClickSession(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('0s', $addOfferDto->getMinimalClickSession());
    }

    public function testGetExternalOfferId(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('5a97f4af94b814997c8b456a', $addOfferDto->getExternalOfferId());
    }

    public function testGetBundleId(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('5jfj7jjs0amcslsaaah', $addOfferDto->getBundleId());
    }

    public function testGetSubRestrictions(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals([['sub1' => 'sub_value1', 'sub2' => 'sub_value2']], $addOfferDto->getSubRestrictions());
    }

    public function testGetCapsTimezone(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('Europe/Moscow', $addOfferDto->getCapsTimezone());
    }

    public function testGetStrictlyIsp(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(['595e3b5b7e28fede7b8b456d'], $addOfferDto->getStrictlyIsp());
    }

    public function testGetNoteAff(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('', $addOfferDto->getNoteAff());
    }

    public function testGetNoteSales(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('', $addOfferDto->getNoteSales());
    }

    public function testGetDisallowedIp(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('', $addOfferDto->getDisallowedIp());
    }

    public function testGetHideCaps(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $addOfferDto->getHideCaps());
    }

    public function testGetCapsStatus(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(['confirmed'], $addOfferDto->getCapsStatus());
    }

    public function testGetCapsGoalOvercap(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals('install', $addOfferDto->getCapsGoalOvercap());
    }

    public function testGetCommissionTiers(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CommissionTierDto([
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
                ]),
            ],
            $addOfferDto->getCommissionTiers()
        );
    }

    public function testIsConsiderPersonalTargetingOnly(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $addOfferDto->getConsiderPersonalTargetingOnly());
    }

    public function testGetMacroUrl(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['macro_url' => 'quaerat']);
        $this->assertEquals('quaerat', $addOfferDto->getMacroUrl());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['macro_url' => null]);
        $this->assertNull($addOfferDto->getMacroUrl());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes);
        $this->assertNull($addOfferDto->getMacroUrl());
    }

    public function testGetNoticePercentOvercap(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['notice_percent_overcap' => 'explicabo']);
        $this->assertEquals('explicabo', $addOfferDto->getNoticePercentOvercap());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['notice_percent_overcap' => null]);
        $this->assertNull($addOfferDto->getNoticePercentOvercap());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes);
        $this->assertNull($addOfferDto->getNoticePercentOvercap());
    }

    public function testGetNotes(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['notes' => 'laudantium']);
        $this->assertEquals('laudantium', $addOfferDto->getNotes());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['notes' => null]);
        $this->assertNull($addOfferDto->getNotes());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes);
        $this->assertNull($addOfferDto->getNotes());
    }

    public function testGetHashPassword(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['hash_password' => '125f4f71ed3a9683f847a423be93d8c7bb8d4359']);
        $this->assertEquals('125f4f71ed3a9683f847a423be93d8c7bb8d4359', $addOfferDto->getHashPassword());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['hash_password' => null]);
        $this->assertNull($addOfferDto->getHashPassword());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes);
        $this->assertNull($addOfferDto->getHashPassword());
    }

    public function testGetStopAt(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['stop_at' => '2020-12-27T05:58:06+00:00']);
        $this->assertEquals('2020-12-27T05:58:06+00:00', $addOfferDto->getStopAt());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['stop_at' => null]);
        $this->assertNull($addOfferDto->getStopAt());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes);
        $this->assertNull($addOfferDto->getStopAt());
    }

    public function testGetAutoOfferConnect(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['auto_offer_connect' => 'consectetur']);
        $this->assertEquals('consectetur', $addOfferDto->getAutoOfferConnect());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['auto_offer_connect' => null]);
        $this->assertNull($addOfferDto->getAutoOfferConnect());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes);
        $this->assertNull($addOfferDto->getAutoOfferConnect());
    }

    public function testGetCreativesZip(): void
    {
        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['creatives_zip' => 'illum']);
        $this->assertEquals('illum', $addOfferDto->getCreativesZip());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($addOfferDto->getCreativesZip());

        $addOfferDto = new AddOfferDto(static::$requiredAttributes);
        $this->assertNull($addOfferDto->getCreativesZip());
    }
}
