<?php 

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Response;
use Affise\Sdk\Transport\TransportInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
* Class ByBrowserVersionStatisticsProviderTest
*/
class ByBrowserVersionStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                            'slice' => ['browser_version' => '14.2'],
            'traffic' => ['raw' => '3', 'uniq' => '3'],
            'actions' => ['total' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0], 'confirmed' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0], 'pending' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0], 'declined' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0], 'not_found' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0], 'hold' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0]],
            'views' => 0,
            'ctr' => 0,
            'ecpm' => 0,
            'cr' => ['total' => 0, 'confirmed' => 0, 'pending' => 0, 'declined' => 0, 'not_found' => 0, 'hold' => 0],
            'ratio' => '',
            'epc' => 0,
            'trafficback' => 0,

            ]
        ];
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @psalm-suppress InvalidArgument
    */
    public function testByBrowserVersionFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byBrowserVersion([]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testByBrowserVersionWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'locale' => 'kcg_NG',
            'timezone' => 'America/Santiago',
            'page' => 1,
            'limit' => 9,
            'orderType' => 'asc',
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'currency' => ['USD'],
                'advertiser' => 'ut',
                'offer' => [863925482],
                'manager' => 'quia',
                'advertiser_manager_id' => 'nihil',
                'partner' => ['nihil'],
                'country' => 'US',
                'os' => 'nam',
                'goal' => ['sapiente'],
                'sub1' => ['ut'],
                'sub2' => 'consequatur',
                'sub3' => 'iusto',
                'sub4' => 'vel',
                'sub5' => ['corrupti'],
                'sub6' => 'omnis',
                'sub7' => ['repellendus'],
                'sub8' => 'sint',
                'device' => 'velit',
                'advertiser_tag' => 'qui',
                'affiliate_tag' => 'aut',
                'offer_tag' => 'sed',
            ]
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbybrowsersversion', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byBrowserVersion($filters);
    }
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testByBrowserVersionFailsWhenFilterDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_from]' is required");

        $statisticsProvider->byBrowserVersion([
            'filter' => [
                'date_to' => '2020-12-20',
            ],
        ]);
    }
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testByBrowserVersionFailsWhenFilterDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_to]' is required");

        $statisticsProvider->byBrowserVersion([
            'filter' => [
                'date_from' => '2020-12-20',
            ],
        ]);
    }

 /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testByBrowserVersionResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbybrowsersversion')
            ->willReturn([
                'status' => 1,
                'stats' => $attributes,
                'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
            ]);

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byBrowserVersion([
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
            ],
        ]);

        $expectedData = array_map(fn(array $a) => new StatisticDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
    }

    /**
    * @param string $exceptionClass
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
    public function testByBrowserVersionFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byBrowserVersion([
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
            ],
        ]);
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
