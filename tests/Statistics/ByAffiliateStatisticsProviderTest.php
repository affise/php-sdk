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
 * Class ByAffiliateStatisticsProviderTest
 */
class ByAffiliateStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'slice' => [
                    'affiliate' => [
                        'id' => 6,
                        'title' => 'IVAN',
                        'email' => 'yyyyy@gmail.com',
                        'login' => 'IVAN',
                        'name' => 'IVAN',
                    ],
                ],
                'traffic' => ['raw' => '4', 'uniq' => '4'],
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
                'epc' => 0,
                'trafficback' => 2,
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
    public function testByAffiliateFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byAffiliate([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByAffiliateWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'locale' => 'fr_SN',
            'timezone' => 'Asia/Omsk',
            'page' => 1,
            'limit' => 8,
            'orderType' => 'desc',
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'currency' => ['USD'],
                'advertiser' => ['rem'],
                'offer' => [1434577892],
                'manager' => ['dolores'],
                'advertiser_manager_id' => ['velit'],
                'partner' => ['sunt'],
                'country' => 'US',
                'os' => ['est'],
                'goal' => 'non',
                'sub1' => 'perspiciatis',
                'sub2' => ['eum'],
                'sub3' => ['ducimus'],
                'sub4' => 'labore',
                'sub5' => ['maiores'],
                'sub6' => 'voluptas',
                'sub7' => 'consectetur',
                'sub8' => ['rem'],
                'device' => ['nesciunt'],
                'advertiser_tag' => 'ipsa',
                'affiliate_tag' => 'rem',
                'offer_tag' => 'illo',
            ],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbypartner', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byAffiliate($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByAffiliateFailsWhenFilterDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_from]' is required");

        $statisticsProvider->byAffiliate(
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
    public function testByAffiliateFailsWhenFilterDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_to]' is required");

        $statisticsProvider->byAffiliate(
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
    public function testByAffiliateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbypartner')
            ->willReturn(
                [
                    'status' => 1,
                    'stats' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byAffiliate(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'date_to' => '2020-12-20',
                ],
            ]
        );

        $expectedData = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['affiliate'] = new AffiliateDto($slice['affiliate']);
            $item['slice'] = $slice;

            return new StatisticDto($item);
        }, $attributes);

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
    public function testByAffiliateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byAffiliate(
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
