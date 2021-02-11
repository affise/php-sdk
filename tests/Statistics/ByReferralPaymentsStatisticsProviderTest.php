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
 * Class ByReferralPaymentsStatisticsProviderTest
 */
class ByReferralPaymentsStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'total' => [
                    'count' => '0',
                    'sum_revenue' => '',
                    'sum_revenue_pay' => '',
                    'sum_revenue_paid' => '',
                    'sum_revenue_hold' => '',
                ],
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
    public function testByReferralPaymentsFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byReferralPayments([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByReferralPaymentsWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'date_from' => '2020-12-20',
            'date_to' => '2020-12-20',
            'pid' => 2029866614,
            'ref' => 1138258303,
            'is_paid' => 217664574,
            'status' => 1350491662,
            'page' => 7,
            'limit' => 4,
            'currency' => 'USD',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getreferralpayments', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byReferralPayments($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByReferralPaymentsFailsWhenDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_from' is required");

        $statisticsProvider->byReferralPayments(
            [
                'date_to' => '2020-12-20',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByReferralPaymentsFailsWhenDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_to' is required");

        $statisticsProvider->byReferralPayments(
            [
                'date_from' => '2020-12-20',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByReferralPaymentsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getreferralpayments')
            ->willReturn(
                [
                    'status' => 1,
                    'ref_payments' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byReferralPayments(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
            ]
        );

        $expectedData = array_map(fn(array $a) => new ByReferralPaymentsDto($a), $attributes);

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
    public function testByReferralPaymentsFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byReferralPayments(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
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
