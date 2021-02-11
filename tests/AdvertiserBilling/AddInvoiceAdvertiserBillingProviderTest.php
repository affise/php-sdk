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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class AddInvoiceAdvertiserBillingProviderTest
 */
class AddInvoiceAdvertiserBillingProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testAddInvoiceFailsWhenFiltersAreNotSet(): void
    {
        $advertiserBillingProvider = new AdvertiserBillingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $advertiserBillingProvider->addInvoice([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddInvoiceWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'supplier_id' => '5a37c01cbf0b6b18008b4567',
            'start_date' => '2017-12-05',
            'end_date' => '2017-12-20',
            'status' => 'paid',
            'currency' => 'USD',
            'comment' => 'magni',
            'detail' => [
                [
                    'offer_id' => 2061134156,
                    'payout_type' => 'RPC',
                    'actions' => 1610553010,
                    'amount' => 64976435,
                    'comment' => 'ipsa',
                ]
            ],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser-invoice', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);
        $advertiserBillingProvider->addInvoice($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddInvoiceFailsWhenSupplierIdIsNotPassed(): void
    {
        $advertiserBillingProvider = new AdvertiserBillingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'supplier_id' is required");

        $advertiserBillingProvider->addInvoice(
            [
                'currency' => 'USD',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddInvoiceFailsWhenCurrencyIsNotPassed(): void
    {
        $advertiserBillingProvider = new AdvertiserBillingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'currency' is required");

        $advertiserBillingProvider->addInvoice(
            [
                'supplier_id' => '5a37c01cbf0b6b18008b4567',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddInvoiceResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser-invoice')
            ->willReturn(
                [
                    'status' => 1,
                    'message' => 'Invoice created.',
                ]
            );

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);
        $response = $advertiserBillingProvider->addInvoice(
            [
                'supplier_id' => '5a37c01cbf0b6b18008b4567',
                'currency' => 'USD',
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals('Invoice created.', $response->getMessage());
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
    public function testAddInvoiceFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $advertiserBillingProvider = new AdvertiserBillingProvider($transport);

        $this->expectException($exceptionClass);

        $advertiserBillingProvider->addInvoice(
            [
                'supplier_id' => '5a37c01cbf0b6b18008b4567',
                'currency' => 'USD',
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
