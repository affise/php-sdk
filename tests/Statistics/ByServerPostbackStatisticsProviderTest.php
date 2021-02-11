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
 * Class ByServerPostbackStatisticsProviderTest
 */
class ByServerPostbackStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                '_id' => ['$id' => '5fcdfafd96f0b67522427bf2'],
                '_get' => ['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8'],
                'get' => '{"clickid":"b46e3cc99b5a49b782b85cc6841855e8"}',
                'post' => '[]',
                'server' => 'eaque',
                'supplier' => [
                    'id' => '5f059cf72bdea5690c593e53',
                    'title' => 'WC',
                ],
                'date' => ['sec' => 1607334653, 'usec' => 3207165000],
                'response' => '{"status": 2,"message": "Broken clickid"}',
                'track' => [
                    'id' => '5f4ef574125d9900010927fc',
                    'created_at' => '2020-09-02 04:29:24',
                    'ip' => 'non',
                    'ua' => 'dolor',
                    'sub1' => '',
                    'sub2' => '',
                    'sub3' => '5f4ef57496c6540001af032b',
                    'sub4' => '',
                    'sub5' => '',
                    'sub6' => '',
                    'sub7' => '',
                    'sub8' => '',
                    'offer' => [
                        'id' => 57,
                        'offer_id' => '5f3e4c2e134ed084008b4567',
                        'title' => 'Adult Dates CPL SOI US UK CA AU NZ FI FR NO ZA CH FR WEB/TAB/MOB',
                        'url' => 'http://affise.com',
                    ],
                    'partner_id' => 2,
                    'browser' => 'Mobile Safari',
                    'browser_version' => 'in',
                    'browser_fullname' => 'modi',
                    'os' => 'iOS',
                    'os_version' => 'voluptas',
                    'os_fullname' => 'numquam',
                    'device' => 'Apple',
                    'device_fullname' => '',
                    'device_model' => 'iPhone|iPhone 3G|iPhone 3GS|iPhone 4|iPhone 4S|iPhone 5|iPhone 5S|iPhone 6|iPhone 6 Plus|iPhone 6s|iPhone 6s Plus|iPhone SE|iPhone 7|iPhone 7 Plus|iPhone 8|iPhone 8 Plus|iPhone X|iPhone XR|iPhone XS|iPhone XS Max|iPhone 11 Pro|iPhone 11|iPhone 11 Pro Max',
                    'device_type' => 'mobile',
                    'city' => 'San Antonio',
                    'country' => 'US',
                    'city_id' => 76,
                    'district' => 'accusamus',
                    'connection_type' => 'wi-fi',
                    'isp_code' => '?',
                    'referrer' => '',
                    'landing_id' => 'atque',
                    'prelanding_id' => 'iusto',
                    'smart_id' => '',
                    'landing' => [
                        'id' => '',
                    ],
                    'prelanding' => [
                        'id' => '',
                    ],
                    'ref_id' => '',
                    'os_id' => '',
                    'user_id' => '',
                    'ext1' => '',
                    'ext2' => '',
                    'ext3' => '',
                    'country_name' => 'omnis',
                    'click_id' => 'inventore',
                    'conversion_id' => 'iste',
                    'has_conversions' => false,
                    'cbid' => 'sed',
                    'idfa' => 'hic',
                    'isp' => 0,
                    'uniq' => false,
                    'partner' => [
                        'id' => 2,
                        'login' => '',
                        'email' => 'enoch.terry@example.org',
                        'manager_id' => '5f9008bfafd0ba5d88c4dee8',
                        'name' => 'test',
                        'title' => 'test',
                    ],
                    'supplier_manager_id' => 'non',
                    'unid' => 'impedit',
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
    public function testByServerPostbackFailsWhenFiltersAreNotSet(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $statisticsProvider->byServerPostback([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByServerPostbackWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'date_from' => '2020-12-20',
            'date_to' => '2020-12-20',
            'offer' => [1894495402],
            'partner' => [1472419791],
            'supplier' => ['officiis'],
            'action_id' => 'dolores',
            'click_id' => 'hic',
            'goal' => 'facilis',
            'status' => 'sunt',
            'timezone' => 'Africa/Malabo',
            'page' => 7,
            'limit' => 10,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/serverpostbacks', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->byServerPostback($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testByServerPostbackFailsWhenDateFromIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_from' is required");

        $statisticsProvider->byServerPostback(
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
    public function testByServerPostbackFailsWhenDateToIsNotPassed(): void
    {
        $statisticsProvider = new StatisticsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'date_to' is required");

        $statisticsProvider->byServerPostback(
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
    public function testByServerPostbackResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/serverpostbacks')
            ->willReturn(
                [
                    'status' => 1,
                    'postbacks' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->byServerPostback(
            [
                'date_from' => '2020-12-20',
                'date_to' => '2020-12-20',
            ]
        );

        $expectedData = array_map(fn(array $a) => new ByServerPostbackDto($a), $attributes);

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
    public function testByServerPostbackFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->byServerPostback(
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
