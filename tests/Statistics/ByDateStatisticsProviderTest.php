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
 * Class ByDateStatisticsProviderTest
 */
class ByDateStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'slice' => ['year' => 2020, 'month' => 12, 'day' => 20],
                'traffic' => ['raw' => '0', 'uniq' => '0'],
                'actions' => [
                    'total' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'confirmed' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'pending' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'declined' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'hold' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                    'not_found' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
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
    public function testByDateFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byDate([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByDateWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'locale' => 'zh_TW',
            'timezone' => 'Asia/Qatar',
            'page' => 1,
            'limit' => 3,
            'orderType' => 'eaque',
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-31',
                'currency' => 'USD',
                'advertiser' => [1491724741, 1555662350],
                'offer' => 635699375,
                'manager' => '59359e1d7e28feb7568b456a',
                'advertiser_manager_id' => ['59359e1d7e28feb7568b456a'],
                'partner' => [1280563339],
                'country' => 'quia',
                'os' => ['Firefox OS'],
                'goal' => ['eligendi'],
                'sub1' => ['fugiat', 'perferendis'],
                'sub2' => 'nemo',
                'sub3' => 'fugiat',
                'sub4' => 'perferendis',
                'sub5' => 'ipsa',
                'sub6' => ['fugiat'],
                'sub7' => ['fugiat', 'perferendis'],
                'sub8' => ['fugiat', 'perferendis'],
                'device' => 'phone',
                'advertiser_tag' => 'cumque',
                'affiliate_tag' => 'ipsa',
                'offer_tag' => 'consequuntur',
            ],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbydate', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byDate($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByDateFailsWhenFilterDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_from]' is required");

        $statisticsProvider->byDate(
            [
                'filter' => ['date_to' => '2020-12-31'],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByDateFailsWhenFilterDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_to]' is required");

        $statisticsProvider->byDate(
            [
                'filter' => ['date_from' => '2020-12-20'],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByDateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbydate')
            ->willReturn(
                [
                    'status' => 1,
                    'stats' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byDate(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
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
    public function testByDateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byDate(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
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
