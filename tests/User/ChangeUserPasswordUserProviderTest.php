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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangeUserPasswordUserProviderTest
 */
class ChangeUserPasswordUserProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testChangeUserPasswordDataIsSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $data = ['password' => '123456'];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/user/5fe360de2d5119ff779037fe/password', $data)
            ->willReturn(
                [
                    'status' => 1,
                    'user' => [
                        'id' => '5fe360de2d5119ff779037fe',
                        'password' => '123456',
                    ],
                ]
            );

        $userProvider = new UserProvider($transport);
        $userProvider->changeUserPassword('5fe360de2d5119ff779037fe', $data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testChangeUserPasswordFailsWhenPasswordIsNotPassed(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'password' is required");

        $userProvider->changeUserPassword('5fe360de2d5119ff779037fe', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testChangeUserPasswordResponse(): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $attributes = [
            'id' => '5fe360de2d5119ff779037fe',
            'password' => '123456',
        ];

        $transport->method('post')
            ->willReturn(
                [
                    'status' => 1,
                    'user' => $attributes,
                ]
            );

        $userProvider = new UserProvider($transport);
        $response = $userProvider->changeUserPassword('5fe360de2d5119ff779037fe', ['password' => '123456']);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(ChangeUserPasswordDto::class, $response->getData());
        $this->assertEquals(new ChangeUserPasswordDto($attributes), $response->getData());
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
    public function testChangeUserPasswordFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $userProvider = new UserProvider($transport);

        $this->expectException($exceptionClass);

        $userProvider->changeUserPassword('5fe360de2d5119ff779037fe', ['password' => '123456']);
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
