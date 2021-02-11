<?php

declare(strict_types=1);

namespace Affise\Sdk\AdvertiserBilling;

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
 * Class InvoicesListAdvertiserBillingProviderTest
 */
class InvoicesListAdvertiserBillingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'number' => 1,
                'supplier_id' => '5a37c01cbf0b6b18008b4567',
                'created_at' => '2018-01-11',
                'updated_at' => '2018-01-11',
                'start_date' => '2017-12-05',
                'end_date' => '2017-12-07',
                'status' => 'unpaid',
                'detail' => [
                    [
                        'offer_id' => 1,
                        'payout_type' => 'RPA',
                        'actions' => 100,
                        'amount' => 100,

                    ],
                ],
                'currency' => 'USD',
                'comment' => 'some comment',

            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testInvoicesListShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/advertiser-invoices', [])
            ->willReturn(
                [
                    'status' => 1,
                    'message' => [
                        [
                            'number' => 1,
                            'supplier_id' => '5a37c01cbf0b6b18008b4567',
                            'created_at' => '2018-01-11',
                            'updated_at' => '2018-01-11',
                            'start_date' => '2017-12-05',
                            'end_date' => '2017-12-07',
                            'status' => 'unpaid',
                            'detail' => [
                                [
                                    'offer_id' => 1,
                                    'payout_type' => 'RPA',
                                    'actions' => 100,
                                    'amount' => 100,
                                    'comment' => null,
                                ],
                            ],
                            'currency' => 'USD',
                            'comment' => null,
                        ],
                        [
                            'number' => 2,
                            'supplier_id' => '5a37c01cbf0b6b18008b4567',
                            'created_at' => '2018-01-11',
                            'updated_at' => '2018-01-11',
                            'start_date' => '2018-01-11',
                            'end_date' => '2018-01-11',
                            'status' => 'unpaid',
                            'detail' => [
                                [
                                    'offer_id' => 1,
                                    'payout_type' => 'RPA',
                                    'actions' => 55,
                                    'amount' => 666,
                                    'comment' => null,
                                ],
                            ],
                            'currency' => 'USD',
                            'comment' => 'some comment',
                        ],
                    ],
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);
        $advertiserBillingProvider->invoicesList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testInvoicesListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'page' => 8,
            'limit' => 1,
            'status' => 'ullam',
            'start_date' => 'odit',
            'end_date' => 'quos',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/advertiser-invoices', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);
        $advertiserBillingProvider->invoicesList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testInvoicesListContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'page' => 8,
            'limit' => 1,
            'status' => 'ullam',
            'start_date' => 'odit',
            'end_date' => 'quos',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/advertiser-invoices', $filters, ['Content-Type' => 'multipart/form-data'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);
        $advertiserBillingProvider->invoicesList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testInvoicesListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            [
                'number' => 1,
                'supplier_id' => '5a37c01cbf0b6b18008b4567',
                'created_at' => '2018-01-11',
                'updated_at' => '2018-01-11',
                'start_date' => '2017-12-05',
                'end_date' => '2017-12-07',
                'status' => 'unpaid',
                'detail' => [
                    [
                        'offer_id' => 1,
                        'payout_type' => 'RPA',
                        'actions' => 100,
                        'amount' => 100,
                        'comment' => null,
                    ],
                ],
                'currency' => 'USD',
                'comment' => null,
            ],
            [
                'number' => 2,
                'supplier_id' => '5a37c01cbf0b6b18008b4567',
                'created_at' => '2018-01-11',
                'updated_at' => '2018-01-11',
                'start_date' => '2018-01-11',
                'end_date' => '2018-01-11',
                'status' => 'unpaid',
                'detail' => [
                    [
                        'offer_id' => 1,
                        'payout_type' => 'RPA',
                        'actions' => 55,
                        'amount' => 666,
                        'comment' => null,
                    ],
                ],
                'currency' => 'USD',
                'comment' => 'some comment',
            ],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/advertiser-invoices')
            ->willReturn(
                [
                    'status' => 1,
                    'message' => $attributes,
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);
        $response = $advertiserBillingProvider->invoicesList();

        $expectedData = array_map(fn(array $a) => new InvoiceDto($a), $attributes);

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
    public function testInvoicesListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);

        $this->expectException($exceptionClass);

        $advertiserBillingProvider->invoicesList();
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
