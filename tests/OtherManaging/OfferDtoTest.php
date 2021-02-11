<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\Offers\SourceDto;
use PHPUnit\Framework\TestCase;

/**
 * Class OfferDtoTest
 */
class OfferDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
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
                'en' => '<p>Please only good quality traffic, we are 100% untollarante to any fraud or bad quality<br />
We are private networks so we can make for you much more EPC that other that&#39;s why we need only super quality traffic</p>',
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
        ];
    }

    public function testGetId(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(81, $offerDto->getId());
    }

    public function testGetOfferId(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('5f61df8c134ed051008b4569', $offerDto->getOfferId());
    }

    public function testGetTitle(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('MT Adult Dating Smartlink CPL WW', $offerDto->getTitle());
    }

    public function testGetPreviewUrl(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('quidem', $offerDto->getPreviewUrl());
    }

    public function testGetCrossPostbackUrl(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('', $offerDto->getCrossPostbackUrl());
    }

    public function testGetDescriptionLang(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(
            ['ru' => '', 'en' => '', 'cn' => '', 'es' => '', 'ka' => '', 'vi' => '', 'my' => '', 'pt' => ''],
            $offerDto->getDescriptionLang()
        );
    }

    public function testGetCr(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerDto->getCr());
    }

    public function testGetEpc(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerDto->getEpc());
    }

    public function testGetSendEmails(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getSendEmails());
    }

    public function testGetLogo(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('consequatur', $offerDto->getLogo());
    }

    public function testGetLogoSource(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('dolores', $offerDto->getLogoSource());
    }

    public function testGetSources(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

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
            $offerDto->getSources()
        );
    }

    public function testGetCategories(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([], $offerDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([], $offerDto->getFullCategories());
    }

    public function testGetPayments(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new PaymentDto(
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
                    ]
                ),
            ],
            $offerDto->getPayments()
        );
    }

    public function testGetGoals(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([''], $offerDto->getGoals());
    }

    public function testGetCaps(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([], $offerDto->getCaps());
    }

    public function testGetCapsTimezone(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('Europe/Moscow', $offerDto->getCapsTimezone());
    }

    public function testGetHideCaps(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerDto->getHideCaps());
    }

    public function testGetRequiredApproval(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(true, $offerDto->getRequiredApproval());
    }

    public function testGetIsCpi(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getIsCpi());
    }

    public function testGetKpi(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'en' => '<p>Please only good quality traffic, we are 100% untollarante to any fraud or bad quality<br />
We are private networks so we can make for you much more EPC that other that&#39;s why we need only super quality traffic</p>',
            ],
            $offerDto->getKpi()
        );
    }

    public function testGetCreatives(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([], $offerDto->getCreatives());
    }

    public function testGetLandings(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([], $offerDto->getLandings());
    }

    public function testGetLinks(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([], $offerDto->getLinks());
    }

    public function testGetMacroUrl(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('', $offerDto->getMacroUrl());
    }

    public function testGetUseHttps(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(true, $offerDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getUseHttp());
    }

    public function testGetHoldPeriod(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerDto->getHoldPeriod());
    }

    public function testGetClickSession(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('1y', $offerDto->getClickSession());
    }

    public function testGetMinimalClickSession(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals('0s', $offerDto->getMinimalClickSession());
    }

    public function testGetDisabledChoicePostbackStatus(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getDisabledChoicePostbackStatus());
    }

    public function testGetStrictlyIsp(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals([], $offerDto->getStrictlyIsp());
    }

    public function testGetTargeting(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

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
                        'url' => '',
                        'block_proxy' => false,
                    ]
                ),
            ],
            $offerDto->getTargeting()
        );
    }

    public function testGetSchedule(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(
            ['enabled' => false, 'date_start' => '', 'date_to' => '', 'timezone' => 'Europe/Moscow'],
            $offerDto->getSchedule()
        );
    }

    public function testGetConsiderPersonalTargetingOnly(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getConsiderPersonalTargetingOnly());
    }

    public function testGetHostsOnly(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getHostsOnly());
    }

    public function testGetUniqIpOnly(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getUniqIpOnly());
    }

    public function testGetRejectNotUniqueIp(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerDto->getRejectNotUniqueIp());
    }

    public function testGetStopAt(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['stop_at' => '2021-01-05T14:14:31+00:00']);
        $this->assertEquals('2021-01-05T14:14:31+00:00', $offerDto->getStopAt());

        $offerDto = new OfferDto(static::$requiredAttributes + ['stop_at' => null]);
        $this->assertNull($offerDto->getStopAt());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getStopAt());
    }

    public function testGetStrictlyCountry(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['strictly_country' => 'omnis']);
        $this->assertEquals('omnis', $offerDto->getStrictlyCountry());

        $offerDto = new OfferDto(static::$requiredAttributes + ['strictly_country' => null]);
        $this->assertNull($offerDto->getStrictlyCountry());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['strictly_os' => 'dolorem']);
        $this->assertEquals('dolorem', $offerDto->getStrictlyOs());

        $offerDto = new OfferDto(static::$requiredAttributes + ['strictly_os' => null]);
        $this->assertNull($offerDto->getStrictlyOs());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getStrictlyOs());
    }

    public function testGetStrictlyBrands(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['strictly_brands' => 'vel']);
        $this->assertEquals('vel', $offerDto->getStrictlyBrands());

        $offerDto = new OfferDto(static::$requiredAttributes + ['strictly_brands' => null]);
        $this->assertNull($offerDto->getStrictlyBrands());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getStrictlyBrands());
    }

    public function testGetCreativesZip(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['creatives_zip' => 'porro']);
        $this->assertEquals('porro', $offerDto->getCreativesZip());

        $offerDto = new OfferDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($offerDto->getCreativesZip());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getCreativesZip());
    }

    public function testGetLink(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['link' => 'incidunt']);
        $this->assertEquals('incidunt', $offerDto->getLink());

        $offerDto = new OfferDto(static::$requiredAttributes + ['link' => null]);
        $this->assertNull($offerDto->getLink());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getLink());
    }

    public function testGetRestrictionIsp(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['restriction_isp' => 'consequatur']);
        $this->assertEquals('consequatur', $offerDto->getRestrictionIsp());

        $offerDto = new OfferDto(static::$requiredAttributes + ['restriction_isp' => null]);
        $this->assertNull($offerDto->getRestrictionIsp());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getRestrictionIsp());
    }

    public function testGetSearchEmptySub(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['search_empty_sub' => 'expedita']);
        $this->assertEquals('expedita', $offerDto->getSearchEmptySub());

        $offerDto = new OfferDto(static::$requiredAttributes + ['search_empty_sub' => null]);
        $this->assertNull($offerDto->getSearchEmptySub());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getSearchEmptySub());
    }

    public function testGetIoDocument(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['io_document' => 'iure']);
        $this->assertEquals('iure', $offerDto->getIoDocument());

        $offerDto = new OfferDto(static::$requiredAttributes + ['io_document' => null]);
        $this->assertNull($offerDto->getIoDocument());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getIoDocument());
    }

    public function testGetImpressionsLink(): void
    {
        $offerDto = new OfferDto(static::$requiredAttributes + ['impressions_link' => 'rerum']);
        $this->assertEquals('rerum', $offerDto->getImpressionsLink());

        $offerDto = new OfferDto(static::$requiredAttributes + ['impressions_link' => null]);
        $this->assertNull($offerDto->getImpressionsLink());

        $offerDto = new OfferDto(static::$requiredAttributes);
        $this->assertNull($offerDto->getImpressionsLink());
    }
}
