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

/**
 * Class OSVersionsListOtherProviderTest
 */
class OSVersionsListOtherProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOSVersionsListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $versions = [
            '11.0',
            '10.12',
            '10.13',
            '10.19',
            '10.17',
            '10.16',
            '10.18',
            '10.12.1',
            '10.12.2',
            '10.12.3',
            '10.12.4',
            '10.12.5',
            '10.12.6',
            '10.13.1',
            '10.13.2',
            '10.13.4',
            '10.13.3',
            '10.14.0',
            '10.12.8',
            '10.13.5',
            '10.13.6',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/oses/Firefox OS')
            ->willReturn(
                [
                    'status' => 1,
                    'versions' => $versions,
                    'pagination' => [
                        'per_page' => 1,
                        'total_count' => 1,
                        'page' => 1,
                    ],
                ]
            );

        $otherProvider = new OtherProvider($transport);
        $response = $otherProvider->osVersionsList('Firefox OS');

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals($versions, $response->getData());
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
    public function testOSVersionsListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherProvider = new OtherProvider($transport);

        $this->expectException($exceptionClass);

        $otherProvider->osVersionsList('Firefox OS');
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
