<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class GetReferralsAffiliateProviderTest
 */
class GetReferralsAffiliateProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'id' => 2,
                'created_at' => '2019-05-04 16:55:58',
                'updated_at' => '2019-05-04 16:57:32',
                'email' => 'maribel44@example.org',
                'login' => 'login',
                'ref_percent' => 'consequatur',
                'name' => 'Beatrice Abbott',
                'notes' => 'Notes',
                'status' => 'active',
                'level' => 0,
                'payment_systems' => [
                    [
                        'id' => 1,
                        'active' => 0,
                        'system' => 'Webmoney',
                        'fields' => ['11111', '22222'],
                        'currency' => 1,
                        'system_id' => 1,
                    ],
                ],
                'customFields' => [
                    [
                        'name' => 'Skype',
                        'value' => 'skype',
                        'label' => 'skype',
                        'id' => 1,
                    ],
                ],
                'balance' => [
                    'RUB' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                    'USD' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                    'EUR' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                    'BTC' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                ],
                'offersCount' => 1,
                'api_key' => 'api_key',
                'address_1' => 'adress 1',
                'address_2' => 'adress 2',
                'city' => 'New York',
                'country' => 'US',
                'zip_code' => '220089',
                'phone' => '375291111111',
                'ref' => '1',
                'sub_accounts' => [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetReferralsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/partner/2/referrals')
            ->willReturn(
                [
                    'status' => 1,
                    'referrals' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->getReferrals(2);

        $expectedData = array_map(fn(array $a) => new AffiliateDto($a), $attributes);

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
    public function testGetReferralsFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->getReferrals(2);
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
