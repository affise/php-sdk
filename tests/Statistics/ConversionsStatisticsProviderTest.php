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
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class ConversionsStatisticsProviderTest
 */
class ConversionsStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'id' => '59359e1d7e28feb7568b456a',
                'action_id' => '59359dcb7e28fee0558b4567',
                'status' => 'confirmed',
                'currency' => 'USD',
                'country' => 'US',
                'district' => '',
                'city' => 'New York',
                'ip' => 'rerum',
                'browser' => 'ut',
                'os' => 'nobis',
                'device' => 'Other',
                'offer' => [
                    'id' => 934,
                    'offer_id' => '59313e097960ad2774b4f274',
                    'title' => 'HD-smart [Web]',
                    'url' => 'http://affise.com/1',
                ],
                'offer_id' => 934,
                'ios_idfa' => '',
                'android_id' => '',
                'sub1' => '',
                'sub2' => '',
                'sub3' => '',
                'sub4' => '',
                'sub5' => '',
                'custom_field_1' => '',
                'custom_field_2' => '',
                'custom_field_3' => '',
                'custom_field_4' => '',
                'custom_field_5' => '',
                'custom_field_6' => '',
                'custom_field_7' => '',
                'ua' => 'architecto',
                'comment' => '',
                'created_at' => '2017-06-06 03:08:29',
                'click_time' => '2017-06-06 03:07:07',
                'referrer' => 'qui',
                'payouts' => 1234,
                'clickid' => '59359dcb7e28fee0558b4567',
                'partner' => [
                    'id' => 610,
                    'email' => 'hoppe.caleigh@example.net',
                    'login' => 'example',
                    'name' => '',
                ],
                'goal_value' => '1',
                'sum' => 0,
                'revenue' => 12345,
                'earnings' => 11111,
                'advertiser' => [
                    'id' => '56cc49dc3b7d9b89058b45f0',
                    'title' => 'Example',
                ],
                'payment_status' => 'opened',
                'is_paid' => '1',

            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testConversionsShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/conversions', [])
            ->willReturn(
                [
                    'status' => 1,
                    'conversions' => static::$attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->conversions([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testConversionsWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'date_from' => 'ut',
            'date_to' => 'quae',
            'update_from_date' => 'distinctio',
            'update_from_hour' => 289689435,
            'status' => 156250067,
            'offer' => 1836286201,
            'advertiser' => 'quae',
            'country' => 'US',
            'browser' => 'cum',
            'action_id' => 'iste',
            'clickid' => 'ipsam',
            'os' => 'molestias',
            'goal' => 'qui',
            'device' => 'rerum',
            'payouts' => 1,
            'currency' => 'USD',
            'hour' => 1958279326,
            'timezone' => 'Africa/Khartoum',
            'custom_field_1' => 'cumque',
            'custom_field_2' => 'beatae',
            'custom_field_3' => 'quo',
            'custom_field_4' => 'distinctio',
            'custom_field_5' => 'iusto',
            'custom_field_6' => 'et',
            'custom_field_7' => 'est',
            'subid1' => 'quo',
            'subid2' => 'expedita',
            'subid3' => 'quisquam',
            'subid4' => 'officia',
            'subid5' => 'corporis',
            'partner' => 1318349899,
            'revenue' => 8,
            'page' => 9,
            'limit' => 8,
            'raw_export' => 895682243,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/conversions', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $statisticsProvider = new StatisticsProvider($transport);
        $statisticsProvider->conversions($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testConversionsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/conversions')
            ->willReturn(
                [
                    'status' => 1,
                    'conversions' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->conversions();

        $expectedData = array_map(fn(array $a) => new ConversionsDto($a), $attributes);

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
    public function testConversionsFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->conversions();
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
