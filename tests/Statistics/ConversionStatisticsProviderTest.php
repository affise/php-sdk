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

/**
 * Class ConversionStatisticsProviderTest
 */
class ConversionStatisticsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => '5bd00d73901fcf20008b4574',
            'action_id' => '5bd00c641d580e000162cf94',
            'status' => 1,
            'conversion_id' => '5bd00d73901fcf20008b4574',
            'cbid' => '5bd00c641d580e000162cf94',
            'currency' => 'USD',
            'offer' => [
                'id' => 7,
                'title' => 'Test Offer',
                'offer_id' => '5b59b752f44d940011105103',
                'url' => 'http://affise.com',
            ],
            'offer_id' => 7,
            'goal' => '',
            'ip' => 'eligendi',
            'country' => '',
            'country_name' => '',
            'city' => 'Undefined',
            'city_id' => 0,
            'isp_code' => '',
            'ua' => 'minima',
            'browser' => 'Unknown Unknown',
            'os' => 'Linux Unknown',
            'device' => 'desktop',
            'device_type' => 'desktop',
            'created_at' => '2018-10-22 09:13:07',
            'click_time' => '2018-10-22 09:08:36',
            'createdAt' => '2018-10-22 09:13:07',
            'updatedAt' => '2018-10-22 09:13:07',
            'clickid' => '5bd00c641d580e000162cf94',
            'partner' => [
                'id' => 2,
                'email' => 'gleichner.kian@example.org',
                'login' => 'Yvette Michael',
                'name' => 'Yvette Michael',
            ],
            'supplier_id' => '5b5f415035752723008b456a',
            'partner_id' => 2,
            'goal_value' => '1',
            'sum' => 0,
            'revenue' => 3,
            'payouts' => 3,
            'earnings' => 3,
            'advertiser' => [
                'id' => '5b5f415035752723008b456a',
                'title' => 'Text supplier 2',
            ],
            'payment_type' => 'fixed',
            'payment_status' => 'opened',
            'is_paid' => '1',
            'charge' => 6,
            'earning' => 3,
            'click_id' => '5bd00c641d580e000162cf94',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testConversionResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/stats/conversionsbyid', ['id' => '5bd00d73901fcf20008b4574'])
            ->willReturn(
                [
                    'status' => 1,
                    'conversion' => $attributes,
                ]
            );

        $statisticsProvider = new StatisticsProvider($transport);
        $response = $statisticsProvider->conversion('5bd00d73901fcf20008b4574');

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(ConversionDto::class, $response->getData());
        $this->assertEquals(new ConversionDto($attributes), $response->getData());
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
    public function testConversionFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $statisticsProvider = new StatisticsProvider($transport);

        $this->expectException($exceptionClass);

        $statisticsProvider->conversion('5bd00d73901fcf20008b4574');
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
