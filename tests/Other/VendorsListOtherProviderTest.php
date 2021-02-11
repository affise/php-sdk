<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

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
 * Class VendorsListOtherProviderTest
 */
class VendorsListOtherProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testVendorsListShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $vendors = [
            'Nextbit',
            'Next',
            'NextBook',
            'NEXTAB',
            'Nextel',
            'NextTab',
            'NEXTPAD',
            'NextWolf'
        ];
        
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/vendors', [])
            ->willReturn(
                [
                    'status' => 1,
                    'vendors' => $vendors,
                ]
            );

        $otherProvider = new OtherProvider($transport);
        $otherProvider->vendorsList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testVendorsListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'q' => 'sint',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/vendors', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherProvider = new OtherProvider($transport);
        $otherProvider->vendorsList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testVendorsListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $vendors = [
            'Nextbit',
            'Next',
            'NextBook',
            'NEXTAB',
            'Nextel',
            'NextTab',
            'NEXTPAD',
            'NextWolf'
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/vendors')
            ->willReturn(
                [
                    'status' => 1,
                    'vendors' => $vendors,
                ]
            );

        $otherProvider = new OtherProvider($transport);
        $response = $otherProvider->vendorsList();

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals($vendors, $response->getData());
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
    public function testVendorsListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherProvider = new OtherProvider($transport);

        $this->expectException($exceptionClass);

        $otherProvider->vendorsList();
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
