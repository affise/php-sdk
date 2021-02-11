<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

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
 * Class ApproveOrRejectTicketOtherManagingProviderTest
 */
class ApproveOrRejectTicketOtherManagingProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testApproveOrRejectTicketShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/ticket/1/offer', [])
            ->willReturn(
                [
                    'status' => 1,
                    'message' => 'Request is successfully',
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->approveOrRejectTicket('1', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testApproveOrRejectTicketWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'do' => 'approve',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/ticket/1/offer', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->approveOrRejectTicket('1', $data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testApproveOrRejectTicketResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/ticket/1/offer')
            ->willReturn(
                [
                    'status' => 1,
                    'message' => 'Request is successfully',
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $response = $otherManagingProvider->approveOrRejectTicket('1');

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals('Request is successfully', $response->getMessage());
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
    public function testApproveOrRejectTicketFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $otherManagingProvider = new OtherManagingProvider($transport);

        $this->expectException($exceptionClass);

        $otherManagingProvider->approveOrRejectTicket('1');
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
