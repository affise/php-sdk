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
 * Class OsesListOtherProviderTest
 */
class OsesListOtherProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOsesListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $oses = [
            'Firefox OS',
            '3DS System Software',
            'DSi System Software',
            'VictorReader Stream',
            'ThreadX',
            'Feedfetcher',
            'Maemo',
            'Series 60',
            'Android with AOKP',
            'Apple TV Software'
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/oses')
            ->willReturn(
                [
                    'status' => 1,
                    'oses' => $oses,
                    'pagination' => [
                        'per_page' => 1,
                        'total_count' => 1,
                        'page' => 1,
                    ],
                ]
            );

        $otherProvider = new OtherProvider($transport);
        $response = $otherProvider->osesList();

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($oses, $response->getData());
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
    public function testOsesListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherProvider = new OtherProvider($transport);

        $this->expectException($exceptionClass);

        $otherProvider->osesList();
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
