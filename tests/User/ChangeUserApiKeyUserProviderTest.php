<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangeUserApiKeyUserProviderTest
 */
class ChangeUserApiKeyUserProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testChangeUserApiKeyIdIsSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/user/api_key/5fe360de2d5119ff779037fe', [])
            ->willReturn(
                [
                    'status' => 1,
                    'user' => [
                        'id' => '5fe360de2d5119ff779037fe',
                        'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
                    ],
                ]
            );

        $userProvider = new UserProvider($transport);
        $userProvider->changeUserApiKey('5fe360de2d5119ff779037fe');
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testChangeUserApiKeyResponse(): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $attributes = [
            'id' => '5fe360de2d5119ff779037fe',
            'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
        ];

        $transport->method('post')
            ->willReturn(
                [
                    'status' => 1,
                    'user' => $attributes,
                ]
            );

        $userProvider = new UserProvider($transport);
        $response = $userProvider->changeUserApiKey('5fe360de2d5119ff779037fe');

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(ChangeUserApiKeyDto::class, $response->getData());
        $this->assertEquals(new ChangeUserApiKeyDto($attributes), $response->getData());
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
     * @psalm-suppress UnsafeInstantiation
     */
    public function testChangeUserApiKeyFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $userProvider = new UserProvider($transport);

        $this->expectException($exceptionClass);

        $userProvider->changeUserApiKey('5fe360de2d5119ff779037fe');
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
