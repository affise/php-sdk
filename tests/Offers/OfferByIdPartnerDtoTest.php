<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class OfferByIdPartnerDtoTest
 */
class OfferByIdPartnerDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
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

    public function testGetId(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(11, $offerByIdPartnerDto->getId());
    }

    public function testGetOfferId(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('5f05f2f5134ed05c008b4568', $offerByIdPartnerDto->getOfferId());
    }

    public function testGetTitle(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('Mr.', $offerByIdPartnerDto->getTitle());
    }

    public function testGetPreviewUrl(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $offerByIdPartnerDto->getPreviewUrl());
    }

    public function testGetDescriptionLang(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'ru' => '<p>This offer requires approval from your AM</p>',
                'en' => '<p>This offer requires approval from your AM</p>',
                'cn' => '',
                'es' => '',
                'ka' => '',
                'vi' => '',
                'my' => '',
                'pt' => '',
            ],
            $offerByIdPartnerDto->getDescriptionLang()
        );
    }

    public function testGetLogo(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('est', $offerByIdPartnerDto->getLogo());
    }

    public function testGetLogoSource(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('fugiat', $offerByIdPartnerDto->getLogoSource());
    }

    public function testGetStopAt(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('', $offerByIdPartnerDto->getStopAt());
    }

    public function testGetSources(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

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
            $offerByIdPartnerDto->getSources()
        );
    }

    public function testGetCategories(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(['Dating Adult'], $offerByIdPartnerDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [new FullCategoryDto(['id' => '5f1845f9134ed050008b4568', 'title' => 'Dating Adult'])],
            $offerByIdPartnerDto->getFullCategories()
        );
    }

    public function testGetPayments(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new PaymentDto(
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
                    ]
                ),
            ],
            $offerByIdPartnerDto->getPayments()
        );
    }

    public function testGetCaps(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new CapDto(
                    [
                        'goals' => [],
                        'period' => 'day',
                        'type' => 'conversions',
                        'value' => 100,
                        'goal_type' => 'all',
                        'country_type' => 'all',
                        'country' => [],
                    ]
                ),
            ],
            $offerByIdPartnerDto->getCaps()
        );
    }

    public function testGetRequiredApproval(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(true, $offerByIdPartnerDto->getRequiredApproval());
    }

    public function testGetStrictlyCountry(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerByIdPartnerDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdPartnerDto->getStrictlyOs());
    }

    public function testGetStrictlyBrands(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdPartnerDto->getStrictlyBrands());
    }

    public function testGetIsCpi(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->getIsCpi());
    }

    public function testGetCreatives(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdPartnerDto->getCreatives());
    }

    public function testGetLandings(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new LandingDto(
                    [
                        'id' => 1599727659,
                        'title' => 'Greymobile *Responsive tour, will look different on a mobile device',
                        'url' => 'http://affise.com',
                        'url_preview' => 'http://affise.com',
                        'type' => 'landing',
                    ]
                ),
            ],
            $offerByIdPartnerDto->getLandings()
        );
    }

    public function testGetLinks(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new LinkDto(
                    [
                        'url' => 'http://affise.com',
                        'postbacks' => [],
                    ]
                ),
            ],
            $offerByIdPartnerDto->getLinks()
        );
    }

    public function testGetLink(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('est', $offerByIdPartnerDto->getLink());
    }

    public function testGetUseHttps(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(true, $offerByIdPartnerDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->getUseHttp());
    }

    public function testGetHoldPeriod(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(0, $offerByIdPartnerDto->getHoldPeriod());
    }

    public function testGetKpi(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'en' => '<p>Not fans of pop traffic, if so please use prelanders</p>',
            ],
            $offerByIdPartnerDto->getKpi()
        );
    }

    public function testGetClickSession(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('1y', $offerByIdPartnerDto->getClickSession());
    }

    public function testGetMinimalClickSession(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('0s', $offerByIdPartnerDto->getMinimalClickSession());
    }

    public function testGetStrictlyIsp(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdPartnerDto->getStrictlyIsp());
    }

    public function testGetRestrictionIsp(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offerByIdPartnerDto->getRestrictionIsp());
    }

    public function testGetTargeting(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

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
                        'block_proxy' => false,
                    ]
                ),
            ],
            $offerByIdPartnerDto->getTargeting()
        );
    }

    public function testGetConsiderPersonalTargetingOnly(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->getConsiderPersonalTargetingOnly());
    }

    public function testGetHostsOnly(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->getHostsOnly());
    }

    public function testGetUniqIpOnly(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->getUniqIpOnly());
    }

    public function testGetRejectNotUniqIp(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->getRejectNotUniqIp());
    }

    public function testGetCreativesZip(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['creatives_zip' => 'quisquam']);
        $this->assertEquals('quisquam', $offerByIdPartnerDto->getCreativesZip());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($offerByIdPartnerDto->getCreativesZip());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);
        $this->assertNull($offerByIdPartnerDto->getCreativesZip());
    }

    public function testGetImpressionsLink(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['impressions_link' => 'voluptatem']);
        $this->assertEquals('voluptatem', $offerByIdPartnerDto->getImpressionsLink());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['impressions_link' => null]);
        $this->assertNull($offerByIdPartnerDto->getImpressionsLink());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);
        $this->assertNull($offerByIdPartnerDto->getImpressionsLink());
    }

    public function testGetMacroUrl(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['macro_url' => 'http://affise.com']);
        $this->assertEquals('http://affise.com', $offerByIdPartnerDto->getMacroUrl());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['macro_url' => null]);
        $this->assertNull($offerByIdPartnerDto->getMacroUrl());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);
        $this->assertNull($offerByIdPartnerDto->getMacroUrl());
    }

    public function testGetCapsTimezone(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals('Europe/Moscow', $offerByIdPartnerDto->getCapsTimezone());
    }

    public function testGetDisabledChoicePostbackStatus(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->getDisabledChoicePostbackStatus());
    }

    public function testIsTicketCreated(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offerByIdPartnerDto->isTicketCreated());
    }

    public function testGetSubRestrictions(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['sub_restrictions' => ['test']]);

        $this->assertEquals(['test'], $offerByIdPartnerDto->getSubRestrictions());
    }

    public function testGetRedirectType(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['redirect_type' => 'http302']);
        $this->assertEquals('http302', $offerByIdPartnerDto->getRedirectType());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['redirect_type' => null]);
        $this->assertNull($offerByIdPartnerDto->getRedirectType());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);
        $this->assertNull($offerByIdPartnerDto->getRedirectType());
    }

    public function testGetStrictlyDevices(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['strictly_devices' => ['android']]);

        $this->assertEquals(['android'], $offerByIdPartnerDto->getStrictlyDevices());
    }

    public function testGetCapsStatus(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['caps_status' => ['confirmed']]);
        $this->assertEquals(['confirmed'], $offerByIdPartnerDto->getCapsStatus());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);
        $this->assertEmpty($offerByIdPartnerDto->getCapsStatus());
    }

    public function testGetSearchEmptySub(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['search_empty_sub' => 'esse']);
        $this->assertEquals('esse', $offerByIdPartnerDto->getSearchEmptySub());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['search_empty_sub' => null]);
        $this->assertNull($offerByIdPartnerDto->getSearchEmptySub());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);
        $this->assertNull($offerByIdPartnerDto->getSearchEmptySub());
    }

    public function testGetIoDocument(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['io_document' => 'fugit']);
        $this->assertEquals('fugit', $offerByIdPartnerDto->getIoDocument());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['io_document' => null]);
        $this->assertNull($offerByIdPartnerDto->getIoDocument());

        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes);
        $this->assertNull($offerByIdPartnerDto->getIoDocument());
    }

    public function testGetGoals(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['goals' => ['test']]);

        $this->assertEquals(['test'], $offerByIdPartnerDto->getGoals());
    }

    public function testGetPostbacks(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['postbacks' => ['test']]);

        $this->assertEquals(['test'], $offerByIdPartnerDto->getPostbacks());
    }

    public function testGetPixels(): void
    {
        $offerByIdPartnerDto = new OfferByIdPartnerDto(static::$requiredAttributes + ['pixels' => ['test']]);

        $this->assertEquals(['test'], $offerByIdPartnerDto->getPixels());
    }
}

