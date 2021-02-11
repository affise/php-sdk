<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Offers\OffersListPartnerDto;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class OfferListAffiliateMethodsProviderTest
 */
class OfferListAffiliateMethodsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'id' => 902,
                'offer_id' => '5718dac83b7d9bf8588b4579',
                'title' => 'Dr.',
                'preview_url' => 'beatae',
                'description' => 'sed',
                'cr' => 199850,
                'epc' => 298988.33,
                'logo' => 'temporibus',
                'logo_source' => 'test',
                'stop_at' => '',
                'sources' => [
                    [
                        'id' => '51f531f53b7d9b1e0382f6d9',
                        'title' => 'Web sites',
                        'allowed' => 1,
                    ],
                ],
                'categories' => ['...'],
                'full_categories' => [
                    [
                        'id' => '5368afb23b7d9b4d5d505342',
                        'title' => 'test',
                    ],
                ],
                'payments' => [
                    [
                        'countries' => ['US'],
                        'cities' => [],
                        'country_exclude' => false,
                        'title' => 'Ms.',
                        'goal' => '1',
                        'revenue' => 150,
                        'currency' => 'USD',
                        'type' => 'fixed',
                        'devices' => [],
                        'os' => [],
                    ],
                ],
                'required_approval' => true,
                'landings' => [],
                'is_cpi' => false,
                'creatives' => [],
                'links' => [
                    [
                        'url' => 'http://affise.com',
                        'postbacks' => [],
                    ],
                ],
                'link' => 'culpa',
                'use_https' => false,
                'use_http' => true,
                'hold_period' => 0,
                'caps' => [
                    [
                        'period' => 'day',
                        'type' => 'conversions',
                        'value' => 100,
                        'goal_type' => 'exact',
                        'goals' => ['Install', 'Register'],
                        'country_type' => 'all',
                    ],
                ],
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
                'uniq_ip_only' => false,
                'click_session' => 'test',
                'minimal_click_session' => 'test',
                'consider_personal_targeting_only' => false,
                'hosts_only' => false,
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOfferListShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/partner/offers', [])
            ->willReturn(
                [
                    'status' => 1,
                    'offers' => static::$attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $affiliateMethodsProvider->offerList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOfferListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'q' => 'quos',
            'ids' => ['5718dac83b7d9bf8588b4579'],
            'int_id' => [57018130],
            'countries' => ['US'],
            'categories' => ['5718dac83b7d9bf8588b4579'],
            'sort' => ['id' => 'asc'],
            'page' => 1,
            'limit' => 1,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/partner/offers', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $affiliateMethodsProvider->offerList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOfferListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/partner/offers')
            ->willReturn(
                [
                    'status' => 1,
                    'offers' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $response = $affiliateMethodsProvider->offerList();

        $expectedData = array_map(fn(array $a) => new OffersListPartnerDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
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
    public function testOfferListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateMethodsProvider->offerList();
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
