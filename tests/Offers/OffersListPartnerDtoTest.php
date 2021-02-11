<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class OffersListPartnerDtoTest
 */
class OffersListPartnerDtoTest extends TestCase
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
        ];
    }

    public function testGetId(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(11, $offersListDto->getId());
    }

    public function testGetOfferId(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('5f05f2f5134ed05c008b4568', $offersListDto->getOfferId());
    }

    public function testGetTitle(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('Mr.', $offersListDto->getTitle());
    }

    public function testGetPreviewUrl(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $offersListDto->getPreviewUrl());
    }

    public function testGetDescriptionLang(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

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
            $offersListDto->getDescriptionLang()
        );
    }

    public function testGetLogo(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('est', $offersListDto->getLogo());
    }

    public function testGetLogoSource(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('fugiat', $offersListDto->getLogoSource());
    }

    public function testGetStopAt(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('', $offersListDto->getStopAt());
    }

    public function testGetSources(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

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

    public function testGetCategories(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(['Dating Adult'], $offersListDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [new FullCategoryDto(['id' => '5f1845f9134ed050008b4568', 'title' => 'Dating Adult'])],
            $offersListDto->getFullCategories()
        );
    }

    public function testGetPayments(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

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
            $offersListDto->getPayments()
        );
    }

    public function testGetCaps(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

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
            $offersListDto->getCaps()
        );
    }

    public function testGetRequiredApproval(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(true, $offersListDto->getRequiredApproval());
    }

    public function testGetStrictlyCountry(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(0, $offersListDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getStrictlyOs());
    }

    public function testGetStrictlyBrands(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getStrictlyBrands());
    }

    public function testGetIsCpi(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getIsCpi());
    }

    public function testGetCreatives(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getCreatives());
    }

    public function testGetLandings(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

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
            $offersListDto->getLandings()
        );
    }

    public function testGetLinks(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new LinkDto(
                    [
                        'url' => 'http://affise.com',
                        'postbacks' => [],
                    ]
                ),
            ],
            $offersListDto->getLinks()
        );
    }

    public function testGetLink(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('est', $offersListDto->getLink());
    }

    public function testGetUseHttps(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(true, $offersListDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getUseHttp());
    }

    public function testGetHoldPeriod(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(0, $offersListDto->getHoldPeriod());
    }

    public function testGetKpi(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'en' => '<p>Not fans of pop traffic, if so please use prelanders</p>',
            ],
            $offersListDto->getKpi()
        );
    }

    public function testGetClickSession(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('1y', $offersListDto->getClickSession());
    }

    public function testGetMinimalClickSession(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals('0s', $offersListDto->getMinimalClickSession());
    }

    public function testGetStrictlyIsp(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getStrictlyIsp());
    }

    public function testGetRestrictionIsp(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals([], $offersListDto->getRestrictionIsp());
    }

    public function testGetTargeting(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

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
            $offersListDto->getTargeting()
        );
    }

    public function testGetConsiderPersonalTargetingOnly(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getConsiderPersonalTargetingOnly());
    }

    public function testGetHostsOnly(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getHostsOnly());
    }

    public function testGetUniqIpOnly(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getUniqIpOnly());
    }

    public function testGetRejectNotUniqIp(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);

        $this->assertEquals(false, $offersListDto->getRejectNotUniqIp());
    }

    public function testGetCreativesZip(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes + ['creatives_zip' => 'quisquam']);
        $this->assertEquals('quisquam', $offersListDto->getCreativesZip());

        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($offersListDto->getCreativesZip());

        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);
        $this->assertNull($offersListDto->getCreativesZip());
    }

    public function testGetImpressionsLink(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes + ['impressions_link' => 'voluptatem']);
        $this->assertEquals('voluptatem', $offersListDto->getImpressionsLink());

        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes + ['impressions_link' => null]);
        $this->assertNull($offersListDto->getImpressionsLink());

        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);
        $this->assertNull($offersListDto->getImpressionsLink());
    }

    public function testGetMacroUrl(): void
    {
        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes + ['macro_url' => 'http://affise.com']);
        $this->assertEquals('http://affise.com', $offersListDto->getMacroUrl());

        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes + ['macro_url' => null]);
        $this->assertNull($offersListDto->getMacroUrl());

        $offersListDto = new OffersListPartnerDto(static::$requiredAttributes);
        $this->assertNull($offersListDto->getMacroUrl());
    }
}
