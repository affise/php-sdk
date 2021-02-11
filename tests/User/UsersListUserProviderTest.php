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
 * Class UserProviderTest
 */
class UsersListUserProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testUsersListShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/users', [])
            ->willReturn(
                [
                    'status' => 1,
                    'users' => [
                        [
                            'id' => '5ee38817fec6270c4804061d',
                            'first_name' => 'Ivan',
                            'last_name' => 'Petrovich',
                            'email' => 'testadmin@gmail.com',
                            'api_key' => '4bd66dda264e195f34b5b319f7abe4a0',
                            'roles' => [Role::ROLE_ADMIN],
                            'type' => 'client',
                        ],
                    ],
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $userProvider = new UserProvider($transport);
        $userProvider->usersList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testUsersListResponse(): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $filters = [
        ];

        $transport->method('get')
            ->willReturn(
                [
                    'status' => 1,
                    'users' => [
                        [
                            'id' => '5ee38817fec6270c4804061d',
                            'first_name' => 'Ivan',
                            'last_name' => 'Petrovich',
                            'work_hours' => '10:00 - 19:00',
                            'email' => 'testadmin@gmail.com',
                            'skype' => 'enim',
                            'api_key' => '4bd66dda264e195f34b5b319f7abe4a0',
                            'roles' => [Role::ROLE_ADMIN],
                            'updated_at' => '2020-12-17 17:50:12',
                            'created_at' => '2020-06-25 15:43:26',
                            'last_login_at' => '2020-12-14 18:29:47',
                            'type' => 'client',
                            'avatar' => 'dGVzdA==',
                        ],
                    ],
                    'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
                ]
            );

        $userProvider = new UserProvider($transport);
        $response = $userProvider->usersList($filters);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
    }

    /**
     * @param string $exceptionClass
     * @psalm-param class-string<\Affise\Sdk\Exception\TransportException> $exceptionClass
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @dataProvider exceptionsProvider
     * @psalm-suppress UnsafeInstantiation
     */
    public function testUsersListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $userProvider = new UserProvider($transport);

        $this->expectException($exceptionClass);

        $userProvider->usersList([]);
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
