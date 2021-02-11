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
use RuntimeException;

/**
 * Class AffiliateListAffiliateProviderTest
 */
class AffiliateListAffiliateProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'id' => 1,
                'created_at' => '2016-11-16 14:13:39',
                'updated_at' => '2016-11-16 14:13:39',
                'email' => '1111@qew.com',
                'login' => 'default',
                'name' => '10',
                'notes' => 'et',
                'status' => 'active',
                'level' => 1,
                'payment_systems' => [
                    [
                        'id' => 10895,
                        'active' => 0,
                        'system' => 'Webmoney WMR',
                        'fields' => ['...'],
                        'currency' => 1,
                        'system_id' => 1,
                    ],
                ],
                'customFields' => [
                    [
                        'name' => 'Skype',
                        'value' => '1',
                        'label' => '1',
                        'id' => 1,
                    ],
                ],
                'balance' => [
                    'USD' => ['balance' => 3418, 'hold' => 0, 'available' => 1050],
                    'RUB' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                ],
                'offersCount' => 46,
                'api_key' => 'aliquid',
                'tags' => [],
                'ref' => '0',
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAffiliateListShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/partners', [])
            ->willReturn(
                [
                    'status' => 1,
                    'partners' => static::$attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->affiliateList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAffiliateListWhenOptionalFiltersAreSet(): void
    {
        $filters = [
            'id' => '502aa3aa2d8fcb7dc045bdc4e9458142bdbd57df',
            'with_balance' => 64051020,
            'limit' => 4,
            'page' => 7,
            'updated_at' => '2020-12-26T09:37:16+00:00',
            'status_partner' => 'ut',
        ];

        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/partners', $filters)
            ->willThrowException(new RuntimeException());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException(RuntimeException::class);

        $affiliateProvider->affiliateList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAffiliateListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/partners')
            ->willReturn(
                [
                    'status' => 1,
                    'partners' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->affiliateList();

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
    public function testAffiliateListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->affiliateList();
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
