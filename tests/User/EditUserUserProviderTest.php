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
 * Class EditUserUserProviderTest
 */
class EditUserUserProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditUserShouldNotFailsWhenDataIsEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/user/5fe360de2d5119ff779037fe', [])
            ->willReturn(
                [
                    'status' => 1,
                    'user' => [
                        'id' => '5fe360de2d5119ff779037fe',
                        'first_name' => 'Trudie',
                        'last_name' => 'Stehr',
                        'email' => 'tromp.stanton@example.com',
                        'api_key' => '32e10878c6276b9106f147f1ba8aa412',
                        'roles' => ['ROLE_SECTION_STATS_COMMON'],
                        'type' => 'common_manager',
                    ],
                ]
            );

        $userProvider = new UserProvider($transport);
        $userProvider->editUser('5fe360de2d5119ff779037fe', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditUserResponse(): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $attributes = [
            'first_name' => 'Trudie',
            'last_name' => 'Stehr',
            'work_hours' => '10:48 - 14:09',
            'email' => 'tromp.stanton@example.com',
            'skype' => 'porro',
            'api_key' => '32e10878c6276b9106f147f1ba8aa412',
            'roles' => ['ROLE_SECTION_STATS_COMMON'],
            'updated_at' => '2020-12-24 20:06:10',
            'created_at' => '2020-12-23 18:23:10',
            'last_login_at' => '2020-12-23T13:53:27+00:00',
            'type' => 'common_manager',
            'avatar' => 'dGVzdA==',
        ];

        $transport->method('post')
            ->willReturn(
                [
                    'status' => 1,
                    'user' => $attributes + ['id' => '5fe360de2d5119ff779037fe'],
                ]
            );

        $userProvider = new UserProvider($transport);
        $response = $userProvider->editUser('5fe360de2d5119ff779037fe', $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(UserDto::class, $response->getData());
        $this->assertEquals(new UserDto($attributes + ['id' => '5fe360de2d5119ff779037fe']), $response->getData());
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
    public function testEditUserFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $userProvider = new UserProvider($transport);

        $this->expectException($exceptionClass);

        $userProvider->editUser('5fe360de2d5119ff779037fe', []);
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
