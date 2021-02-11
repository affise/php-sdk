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
 * Class ByAffiliatesManagersStatisticsProviderTest
 */
class ByAffiliatesManagersStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'slice' => [
                    'affiliate_manager_id' => [
                        'id' => '5f9008bfafd0ba5d88c4dee8',
                        'title' => 'Iren FSgdfddws',
                        'first_name' => 'Iren FSgdfddws',
                        'last_name' => '',
                    ],
                    'manager' => '5f9008bfafd0ba5d88c4dee8',
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
                'ratio' => '',
                'epc' => 0,
                'trafficback' => 4,
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
    public function testByAffiliatesManagersFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byAffiliatesManagers([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByAffiliatesManagersWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'locale' => 'hu_HU',
            'timezone' => 'America/Indiana/Petersburg',
            'page' => 5,
            'limit' => 2,
            'orderType' => 'desc',
            'filter' => [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
                'currency' => ['USD'],
                'advertiser' => ['sed'],
                'offer' => [101662359],
                'manager' => ['neque'],
                'advertiser_manager_id' => ['explicabo'],
                'partner' => 'nam',
                'country' => 'US',
                'os' => ['debitis'],
                'goal' => 'error',
                'sub1' => ['est'],
                'sub2' => 'adipisci',
                'sub3' => 'ipsam',
                'sub4' => 'quam',
                'sub5' => ['nihil'],
                'sub6' => ['maxime'],
                'sub7' => 'nostrum',
                'sub8' => ['facere'],
                'device' => 'tenetur',
                'advertiser_tag' => 'occaecati',
                'affiliate_tag' => 'harum',
                'offer_tag' => 'ex',
            ],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbyaffiliatemanager', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byAffiliatesManagers($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByAffiliatesManagersFailsWhenFilterDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_from]' is required");

        $statisticsProvider->byAffiliatesManagers(
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
    public function testByAffiliatesManagersFailsWhenFilterDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'filter[date_to]' is required");

        $statisticsProvider->byAffiliatesManagers(
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
    public function testByAffiliatesManagersResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/getbyaffiliatemanager')
            ->willReturn(
                [
                    'status' => 1,
                    'stats' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byAffiliatesManagers(
            [
                'filter' => [
                    'date_from' => '2020-12-20',
                    'date_to' => '2020-12-20',
                ],
            ]
        );

        $expectedData = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['affiliate_manager_id'] = new AffiliateManagerDto($slice['affiliate_manager_id']);
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
    public function testByAffiliatesManagersFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byAffiliatesManagers(
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
