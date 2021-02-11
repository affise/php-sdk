<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseOfferDtoTest
 */
class BaseOfferDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 2,
            'offer_id' => '5bdffa7339f65625008b4568',
            'title' => 'Prof.',
            'preview_url' => 'http://affise.com',
            'description_lang' => ['ru' => 'Описание', 'en' => 'Description'],
            'logo' => 'harum',
            'logo_source' => 'vel',
            'stop_at' => '2021-01-18T15:24:27+00:00',
            'sources' => [
                [
                    'id' => '51f531f53b7d9b1e0382f6d9',
                    'title' => 'Web sites',
                    'allowed' => 1,
                ],
            ],
            'categories' => ['laborum'],
            'full_categories' => [
                ['id' => '5368afb23b7d9b4d5d505342', 'title' => '...'],
                ['id' => '55b204663b7d9b460b8b45b2', 'title' => '...'],
            ],
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
            'required_approval' => false,
            'strictly_country' => 1781293771,
            'strictly_os' => ['dolore'],
            'strictly_brands' => [517153996],
            'is_cpi' => true,
            'creatives' => [[1312093315]],
            'landings' => [
                [
                    'id' => 1,
                    'title' => 'Prof.',
                    'url' => 'http://affise.com',
                    'url_preview' => 'eos',
                    'type' => 'landing',
                ],
            ],
            'use_https' => true,
            'use_http' => false,
            'hold_period' => 1069958749,
            'kpi' => ['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''],
            'strictly_isp' => ['debitis', 'ipsa', 'sint'],
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
            'uniq_ip_only' => true,
            'reject_not_uniq_ip' => '88.248.125.78',
        ];
    }

    public function testGetId(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(2, $baseOfferDto->getId());
    }

    public function testGetOfferId(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals('5bdffa7339f65625008b4568', $baseOfferDto->getOfferId());
    }

    public function testGetTitle(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals('Prof.', $baseOfferDto->getTitle());
    }

    public function testGetPreviewUrl(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $baseOfferDto->getPreviewUrl());
    }

    public function testGetDescriptionLang(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => 'Описание', 'en' => 'Description'], $baseOfferDto->getDescriptionLang());
    }

    public function testGetLogo(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals('harum', $baseOfferDto->getLogo());
    }

    public function testGetLogoSource(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals('vel', $baseOfferDto->getLogoSource());
    }

    public function testGetStopAt(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals('2021-01-18T15:24:27+00:00', $baseOfferDto->getStopAt());
    }

    public function testGetSources(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new SourceDto(
                    [
                        'id' => '51f531f53b7d9b1e0382f6d9',
                        'title' => 'Web sites',
                        'allowed' => 1,
                    ],
                ),
            ],
            $baseOfferDto->getSources()
        );
    }

    public function testGetCategories(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(['laborum'], $baseOfferDto->getCategories());
    }

    public function testGetFullCategories(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new FullCategoryDto(['id' => '5368afb23b7d9b4d5d505342', 'title' => '...']),
                new FullCategoryDto(['id' => '55b204663b7d9b460b8b45b2', 'title' => '...']),
            ],
            $baseOfferDto->getFullCategories()
        );
    }

    public function testGetPayments(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

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
                    ],
                ),
            ],
            $baseOfferDto->getPayments()
        );
    }

    public function testGetCaps(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

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
                    ],
                ),
            ],
            $baseOfferDto->getCaps()
        );
    }

    public function testGetRequiredApproval(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $baseOfferDto->getRequiredApproval());
    }

    public function testGetStrictlyCountry(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(1781293771, $baseOfferDto->getStrictlyCountry());
    }

    public function testGetStrictlyOs(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(['dolore'], $baseOfferDto->getStrictlyOs());
    }

    public function testGetStrictlyBrands(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals([517153996], $baseOfferDto->getStrictlyBrands());
    }

    public function testGetIsCpi(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(true, $baseOfferDto->getIsCpi());
    }

    public function testGetCreatives(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals([[1312093315]], $baseOfferDto->getCreatives());
    }

    public function testGetLandings(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new LandingDto(
                    [
                        'id' => 1,
                        'title' => 'Prof.',
                        'url' => 'http://affise.com',
                        'url_preview' => 'eos',
                        'type' => 'landing',
                    ],
                ),
            ],
            $baseOfferDto->getLandings()
        );
    }

    public function testGetUseHttps(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(true, $baseOfferDto->getUseHttps());
    }

    public function testGetUseHttp(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(false, $baseOfferDto->getUseHttp());
    }

    public function testGetHoldPeriod(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(1069958749, $baseOfferDto->getHoldPeriod());
    }

    public function testGetKpi(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => '', 'en' => '', 'es' => '', 'ka' => '', 'vi' => ''], $baseOfferDto->getKpi());
    }

    public function testGetStrictlyIsp(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(['debitis', 'ipsa', 'sint'], $baseOfferDto->getStrictlyIsp());
    }

    public function testGetRestrictionIsp(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes + ['restriction_isp' => ['blanditiis']]);
        $this->assertEquals(['blanditiis'], $baseOfferDto->getRestrictionIsp());

        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes + ['restriction_isp' => null]);
        $this->assertNull($baseOfferDto->getRestrictionIsp());

        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);
        $this->assertNull($baseOfferDto->getRestrictionIsp());
    }

    public function testGetTargeting(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

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
                    ],
                ),
            ],
            $baseOfferDto->getTargeting()
        );
    }

    public function testGetUniqIpOnly(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals(true, $baseOfferDto->getUniqIpOnly());
    }

    public function testGetRejectNotUniqIp(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);

        $this->assertEquals('88.248.125.78', $baseOfferDto->getRejectNotUniqIp());
    }

    public function testGetCreativesZip(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes + ['creatives_zip' => 'cumque']);
        $this->assertEquals('cumque', $baseOfferDto->getCreativesZip());

        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes + ['creatives_zip' => null]);
        $this->assertNull($baseOfferDto->getCreativesZip());

        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);
        $this->assertNull($baseOfferDto->getCreativesZip());
    }

    public function testGetMacroUrl(): void
    {
        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes + ['macro_url' => 'http://affise.com']);
        $this->assertEquals('http://affise.com', $baseOfferDto->getMacroUrl());

        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes + ['macro_url' => null]);
        $this->assertNull($baseOfferDto->getMacroUrl());

        $baseOfferDto = new BaseOfferDto(static::$requiredAttributes);
        $this->assertNull($baseOfferDto->getMacroUrl());
    }
}
