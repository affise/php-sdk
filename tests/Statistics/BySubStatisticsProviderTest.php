<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class BySubStatisticsProviderTest
 */
class BySubStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'slice' => ['sub1' => ''],
                'traffic' => ['raw' => '0', 'uniq' => '0'],
                'actions' => [
                    'total' => [
                        'revenue' => 191190.40796039,
                        'charge' => 339894.05859619,
                        'earning' => 148703.65063587,
                        'null' => 0,
                        'count' => 12600,
                    ],
                    'confirmed' => [
                        'revenue' => 15.173841901617,
                        'charge' => 26.975718936208,
                        'earning' => 11.801877034591,
                        'null' => 0,
                        'count' => 1,
                    ],
                    'pending' => ['revenue' => 0, 'charge' => 0, 'earning' => 0, 'null' => 0, 'count' => 0],
                    'declined' => ['revenue' => 0, 'charge' => 0, 'earning' => 0, 'null' => 0, 'count' => 0],
                    'not_found' => ['revenue' => 0, 'charge' => 0, 'earning' => 0, 'null' => 0, 'count' => 0],
                    'hold' => [
                        'revenue' => 191175.23411849,
                        'charge' => 339867.08287725,
                        'earning' => 148691.84875883,
                        'null' => 0,
                        'count' => 12599,
                    ],
                ],
                'cr' => [
                    'total' => 0,
                    'confirmed' => 0,
                    'pending' => 0,
                    'declined' => 0,
                    'not_found' => 0,
                    'hold' => 0,
                ],
                'epc' => 0,
                'ratio' => '1:NaN',
                'views' => 0,
                'ctr' => 0,
                'ecpm' => 0,
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testBySubFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->bySub([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testBySubWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'locale' => 'ts_ZA',
            'timezone' => 'America/Boa_Vista',
            'page' => 3,
            'limit' => 2,
            'orderType' => 'asc',
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'currency' => ['USD'],
                'advertiser' => ['tempore'],
                'offer' => [1836872922],
                'manager' => ['dolores'],
                'advertiser_manager_id' => 'officia',
                'country' => ['US'],
                'os' => 'maxime',
                'goal' => 'error',
                'sub1' => ['aliquid'],
                'sub2' => 'nostrum',
                'sub3' => 'laudantium',
                'sub4' => ['quod'],
                'sub5' => 'illo',
                'sub6' => ['ut'],
                'sub7' => 'consequatur',
                'sub8' => ['quia'],
                'device' => 'nobis',
                'advertiser_tag' => 'mollitia',
                'affiliate_tag' => 'non',
                'offer_tag' => 'quasi',
            ],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbysub', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->bySub($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testBySubFailsWhenFilterDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_from]' is required");

        $statisticsProvider->bySub(
            [
                'filter' => [
                    'date_to' => '2020-12-20',
                    'offer' => [1836872922],
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testBySubFailsWhenFilterDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_to]' is required");

        $statisticsProvider->bySub(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'offer' => [1836872922],
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testBySubFailsWhenFilterOfferIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[offer]' is required");

        $statisticsProvider->bySub(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'date_to' => '2020-12-20',
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testBySubResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbysub')
            ->willReturn(
                [
                    'status' => 1,
                    'stats' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->bySub(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'date_to' => '2020-12-20',
                    'offer' => [1836872922],
                ],
            ]
        );

        $expectedData = array_map(fn(array $a) => new StatisticDto($a), $attributes);

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
    public function testBySubFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->bySub(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'date_to' => '2020-12-20',
                    'offer' => [1836872922],
                ],
            ]
        );
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
