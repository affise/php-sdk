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

/**
 * Class InvoicesViewAdvertiserBillingProviderTest
 */
class InvoicesViewAdvertiserBillingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'number' => 1,
            'supplier_id' => '5a37c01cbf0b6b18008b4567',
            'created_at' => '2018-01-11',
            'updated_at' => '2018-01-11',
            'start_date' => '2017-12-05',
            'end_date' => '2017-12-07',
            'status' => 'paid',
            'detail' => [
                [
                    'offer_id' => 1,
                    'payout_type' => 'RPA',
                    'actions' => 100,
                    'amount' => 100,

                ],
            ],
            'currency' => 'USD',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testInvoicesViewResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/advertiser-invoice/1')
            ->willReturn(
                [
                    'status' => 1,
                    'message' => static::$attributes,
                ]
            );

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);
        $response = $advertiserBillingProvider->invoicesView(1);

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals(
            new InvoiceDto(static::$attributes),
            $response->getData()
        );
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
    public function testInvoicesViewFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);

        $this->expectException($exceptionClass);

        $advertiserBillingProvider->invoicesView(1);
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
