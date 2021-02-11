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
 * Class ByGoalStatisticsProviderTest
 */
class ByGoalStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'slice' => ['goal' => '1'],
                'traffic' => ['raw' => '1', 'uniq' => '1'],
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
                'ratio' => '',
                'epc' => 0,
                'trafficback' => 0,
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
    public function testByGoalFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byGoal([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByGoalWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'locale' => 'ar_AE',
            'timezone' => 'Pacific/Efate',
            'page' => 4,
            'limit' => 7,
            'orderType' => 'desc',
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'currency' => ['USD'],
                'advertiser' => 'nihil',
                'offer' => [23086312],
                'manager' => 'pariatur',
                'advertiser_manager_id' => ['excepturi'],
                'partner' => 'voluptas',
                'country' => ['US'],
                'os' => ['in'],
                'goal' => ['non'],
                'sub1' => 'quisquam',
                'sub2' => ['magni'],
                'sub3' => 'ut',
                'sub4' => ['vel'],
                'sub5' => 'iure',
                'sub6' => ['aut'],
                'sub7' => 'et',
                'sub8' => 'quos',
                'device' => ['iure'],
                'advertiser_tag' => 'officiis',
                'affiliate_tag' => 'illo',
                'offer_tag' => 'et',
            ],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbygoal', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byGoal($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByGoalFailsWhenFilterDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_from]' is required");

        $statisticsProvider->byGoal(
            [
                'filter' => [
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
    public function testByGoalFailsWhenFilterDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_to]' is required");

        $statisticsProvider->byGoal(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByGoalResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbygoal')
            ->willReturn(
                [
                    'status' => 1,
                    'stats' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byGoal(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'date_to' => '2020-12-20',
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
    public function testByGoalFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byGoal(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'date_to' => '2020-12-20',
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
