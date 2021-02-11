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
 * Class RetentionRateStatisticsProviderTest
 */
class RetentionRateStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'affiliate_id' => 1,
                'date' => '2018-10-18',
                'rr_install' => 66.66,
                'rr_other1' => 100,
                'rr_other2' => 33.33,
                'install_count' => 3,
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
    public function testRetentionRateFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->retentionRate([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRetentionRateWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'date_from' => '2020-12-20',
            'date_to' => '2020-12-20',
            'offer' => 1270098235,
            'base_event' => 'repudiandae',
            'events' => ['odio'],
            'affiliate_id' => 442861419,
            'timezone' => 'Pacific/Easter',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/retentionrate', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->retentionRate($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRetentionRateFailsWhenDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_from' is required");

        $statisticsProvider->retentionRate(
            [
                'date_to' => '2020-12-20',
                'offer' => 1270098235,
                'base_event' => 'repudiandae',
                'events' => ['odio'],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRetentionRateFailsWhenDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_to' is required");

        $statisticsProvider->retentionRate(
            [
                'date_from' => '2020-12-20',
                'offer' => 1270098235,
                'base_event' => 'repudiandae',
                'events' => ['odio'],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRetentionRateFailsWhenOfferIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'offer' is required");

        $statisticsProvider->retentionRate(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'base_event' => 'repudiandae',
                'events' => ['odio'],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRetentionRateFailsWhenBaseEventIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'base_event' is required");

        $statisticsProvider->retentionRate(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'offer' => 1270098235,
                'events' => ['odio'],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRetentionRateFailsWhenEventsIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'events' is required");

        $statisticsProvider->retentionRate(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'offer' => 1270098235,
                'base_event' => 'repudiandae',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRetentionRateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/retentionrate')
            ->willReturn(
                [
                    'status' => 1,
                    'stats' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->retentionRate(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'offer' => 1270098235,
                'base_event' => 'repudiandae',
                'events' => ['odio'],
            ]
        );

        $expectedData = array_map(fn(array $a) => new RetentionRateDto($a), $attributes);

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
    public function testRetentionRateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->retentionRate(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'offer' => 1270098235,
                'base_event' => 'repudiandae',
                'events' => ['odio'],
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
