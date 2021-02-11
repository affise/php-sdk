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
 * Class ByPartnerPostbackStatisticsProviderTest
 */
class ByPartnerPostbackStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                '_id' => ['$id' => '5fa924caeaad4f25d8f9bf52'],
                'date' => ['sec' => 1604920521, 'usec' => 5628768000],
                'pid' => 12,
                'lead_id' => '5fa9240b125d99000173f135',
                'http_code' => 200,
                'postback_url' => 'http://affise.com',
                'offer_id' => 71,
                'goal' => '1',
                'status' => 1,
                'payouts' => 3,
                'revenue' => 4,
                'currency' => 2,
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
    public function testByPartnerPostbackFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byPartnerPostback([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByPartnerPostbackWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'date_from' => '2020-12-20',
            'date_to' => '2020-12-20',
            'offer' => [425045467],
            'partner' => [456624093],
            'goal' => 'provident',
            'status' => 493531468,
            'http_code' => 561604214,
            'timezone' => 'Europe/Ljubljana',
            'page' => 3,
            'limit' => 7,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/affiliatepostbacks', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byPartnerPostback($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByPartnerPostbackFailsWhenDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_from' is required");

        $statisticsProvider->byPartnerPostback(
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
    public function testByPartnerPostbackFailsWhenDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_to' is required");

        $statisticsProvider->byPartnerPostback(
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
    public function testByPartnerPostbackResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/affiliatepostbacks')
            ->willReturn(
                [
                    'status' => 1,
                    'postbacks' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byPartnerPostback(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
            ]
        );

        $expectedData = array_map(fn(array $a) => new ByPartnerPostbackDto($a), $attributes);

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
    public function testByPartnerPostbackFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byPartnerPostback(
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
