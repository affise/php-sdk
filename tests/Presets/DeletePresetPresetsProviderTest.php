<?php

declare(strict_types=1);

namespace Affise\Sdk\Presets;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class DeletePresetPresetsProviderTest
 */
class DeletePresetPresetsProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDeletePresetResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('delete')
            ->with('/3.1/presets/b8d352f8c0e0ddfd2e3fa32308afbe3737fd0ec2')
            ->willReturn(
                [
                    'status' => 1,
                ]
            );

        $presetsProvider = new PresetsProvider($transport);
        $response = $presetsProvider->deletePreset('b8d352f8c0e0ddfd2e3fa32308afbe3737fd0ec2');

        $this->assertEquals(1, $response->getStatus());
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
    public function testDeletePresetFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('delete')->willThrowException(new $exceptionClass());

        $presetsProvider = new PresetsProvider($transport);

        $this->expectException($exceptionClass);

        $presetsProvider->deletePreset('b8d352f8c0e0ddfd2e3fa32308afbe3737fd0ec2');
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
