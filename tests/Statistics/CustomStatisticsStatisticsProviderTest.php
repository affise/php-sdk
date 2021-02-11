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
 * Class CustomStatisticsStatisticsProviderTest
 */
class CustomStatisticsStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'slice' => ['month' => 6],
                'traffic' => ['raw' => '0', 'uniq' => '0'],
                'actions' => [
                    'total' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'confirmed' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'pending' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'declined' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'not_found' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'hold' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                ],
                'views' => 0,
                'ctr' => 0,
                'ecpm' => 0,
                'cr' => [
                    'total' => 0,
                    'confirmed' => 0,
                    'pending' => 0,
                    'declined' => 0,
                    'not_found' => 0,
                    'hold' => 0,
                ],
                'ratio' => '1:NaN',
                'epc' => 0.3172,
                'trafficback' => 1,

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
    public function testCustomStatisticsFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->customStatistics([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCustomStatisticsWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'slice' => 'month',
            'filter' => [
                'date_from' => '2017-11-07',
                'date_to' => '2020-12-31',
                'currency' => 'vitae',
                'advertiser' => 725970815,
                'offer' => 1519918077,
                'manager' => ['laborum', 'maiores'],
                'advertiser_manager_id' => [1527337483],
                'partner' => 'iure',
                'country' => ['US', 'CA'],
                'os' => 1795585309,
                'goal' => 2143048419,
                'sub1' => false,
                'sub2' => 34222214,
                'sub3' => 'voluptatem',
                'sub4' => 'commodi',
                'sub5' => 1024155746,
                'device' => 'dolores',
                'smart_id' => 'dolores',
                'nonzero' => 877549595,
                'advertiser_tag' => 'sint',
                'affiliate_tag' => 'amet',
                'offer_tag' => 'voluptatem',
            ],
            'locale' => 'dv_MV',
            'conversionTypes' => 'error',
            'page' => 3,
            'limit' => 5,
            'orderType' => 'asc',
            'order' => 'month',
            'timezone' => 'Asia/Macau',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/custom', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->customStatistics($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCustomStatisticsFailsWhenSliceIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'slice' is required");

        $statisticsProvider->customStatistics(
            [
                'filter' => [
                    'date_from' => '2017-11-07',
                    'date_to' => '2020-12-31',
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCustomStatisticsFailsWhenFilterDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_from]' is required");

        $statisticsProvider->customStatistics(
            [
                'slice' => 'month',
                'filter' => [
                    'date_to' => '2020-12-31',
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCustomStatisticsFailsWhenFilterDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_to]' is required");

        $statisticsProvider->customStatistics(
            [
                'slice' => 'month',
                'filter' => [
                    'date_from' => '2017-11-07',
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCustomStatisticsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/custom')
            ->willReturn(
                [
                    'status' => 1,
                    'stats' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->customStatistics(
            [
                'slice' => 'month',
                'filter' => [
                    'date_from' => '2017-11-07',
                    'date_to' => '2020-12-31',
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
    public function testCustomStatisticsFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->customStatistics(
            [
                'slice' => 'month',
                'filter' => [
                    'date_from' => '2017-11-07',
                    'date_to' => '2020-12-31',
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
