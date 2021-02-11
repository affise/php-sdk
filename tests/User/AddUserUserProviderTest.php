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
 * Class UserProviderTest
 */
class AddUserUserProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserFailsWhenFiltersAreNotSet(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $userProvider->addUser([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $filters = [
            'email' => 'user@affise.com',
            'password' => '123456',
            'first_name' => 'User',
            'last_name' => 'Affise',
            'roles' => [Role::ROLE_ADMIN],
            'skype' => 'harum',
            'work_hours' => '02:13 - 04:01',
            'avatar' => 'dGVzdA==',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/user', $filters)
            ->willReturn([
                'status' => 1,
                'user' => [
                    'id' => '5ee38817fec6270c4804061d',
                    'first_name' => 'Ivan',
                    'last_name' => 'Petrovich',
                    'email' => 'testadmin@gmail.com',
                    'api_key' => '4bd66dda264e195f34b5b319f7abe4a0',
                    'roles' => [Role::ROLE_ADMIN],
                    'type' => 'client',
                ]
            ]);

        $userProvider = new UserProvider($transport);
        $userProvider->addUser($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserFailsWhenEmailIsNotPassed(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'email' is required");

        $userProvider->addUser(
            [
                'password' => '123456',
                'first_name' => 'User',
                'last_name' => 'Affise',
                'roles' => [Role::ROLE_ADMIN],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserFailsWhenPasswordIsNotPassed(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'password' is required");

        $userProvider->addUser(
            [
                'email' => 'user@affise.com',
                'first_name' => 'User',
                'last_name' => 'Affise',
                'roles' => [Role::ROLE_ADMIN],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserFailsWhenFirstNameIsNotPassed(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'first_name' is required");

        $userProvider->addUser(
            [
                'email' => 'user@affise.com',
                'password' => '123456',
                'last_name' => 'Affise',
                'roles' => [Role::ROLE_ADMIN],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserFailsWhenLastNameIsNotPassed(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'last_name' is required");

        $userProvider->addUser(
            [
                'email' => 'user@affise.com',
                'password' => '123456',
                'first_name' => 'User',
                'roles' => [Role::ROLE_ADMIN],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserFailsWhenRolesIsNotPassed(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'roles' is required");

        $userProvider->addUser(
            [
                'email' => 'user@affise.com',
                'password' => '123456',
                'first_name' => 'User',
                'last_name' => 'Affise',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddUserResponse(): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $attributes = [
            'id' => '5fe360de2d5119ff779037fe',
            'first_name' => 'Trudie',
            'last_name' => 'Stehr',
            'work_hours' => '09:04 - 04:55',
            'email' => 'tromp.stanton@example.com',
            'skype' => 'voluptatum',
            'api_key' => '32e10878c6276b9106f147f1ba8aa412',
            'roles' => [Role::ROLE_SECTION_STATS_COMMON],
            'updated_at' => '2020-12-23 18:23:10',
            'created_at' => '2020-12-23 18:23:10',
            'last_login_at' => '2020-12-23T03:33:47+00:00',
            'type' => 'common_manager',
            'avatar' => 'dGVzdA==',
        ];

        $transport->method('post')->willReturn(['status' => 1, 'user' => $attributes]);

        $userProvider = new UserProvider($transport);
        $response = $userProvider->addUser([
            'email' => 'user@affise.com',
            'password' => '123456',
            'first_name' => 'User',
            'last_name' => 'Affise',
            'roles' => [Role::ROLE_ADMIN],
        ]);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(UserDto::class, $response->getData());
        $this->assertEquals(new UserDto($attributes), $response->getData());
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
    public function testAddUserFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $userProvider = new UserProvider($transport);

        $this->expectException($exceptionClass);

        $userProvider->addUser(
            [
                'email' => 'user@affise.com',
                'password' => '123456',
                'first_name' => 'User',
                'last_name' => 'Affise',
                'roles' => [Role::ROLE_ADMIN],
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
