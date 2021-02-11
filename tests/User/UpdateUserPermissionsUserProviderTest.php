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
 * Class UpdateUserPermissionsUserProviderTest
 */
class UpdateUserPermissionsUserProviderTest extends TestCase
{
    private static array $attributes;
    private static array $permissions;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => '5fe360de2d5119ff779037fe',
            'email' => 'tromp.stanton@example.com',
            'type' => 'common_manager',
            'first_name' => 'Trudie',
            'last_name' => 'Stehr',
            'contacts' => ['skype' => ''],
            'permissions' => [
                'general' => ['marketplace' => ['level' => 'deny'], 'settings' => ['level' => 'deny']],
                'stats' => [
                    'affiliate-postback' => ['level' => 'deny'],
                    'clicks-list' => ['level' => 'deny'],
                    'comparison-report' => ['level' => 'deny'],
                    'conversions-export' => ['level' => 'deny'],
                    'conversions-import' => ['level' => 'deny'],
                    'conversions-list' => ['level' => 'deny'],
                    'entity-account-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'entity-affiliate-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'referral' => ['level' => 'deny'],
                    'server-postback' => ['level' => 'deny'],
                    'slice-account_manager_id' => ['level' => 'deny'],
                    'slice-advertiser_id' => ['level' => 'deny'],
                    'slice-affiliate_id' => ['level' => 'deny'],
                    'slice-affiliate_manager_id' => ['level' => 'deny'],
                    'slice-browser' => ['level' => 'deny'],
                    'slice-city' => ['level' => 'deny'],
                    'slice-connection-type' => ['level' => 'deny'],
                    'slice-country' => ['level' => 'deny'],
                    'slice-day' => ['level' => 'read'],
                    'slice-device' => ['level' => 'deny'],
                    'slice-goal' => ['level' => 'deny'],
                    'slice-landing' => ['level' => 'deny'],
                    'slice-mobile-carrier' => ['level' => 'deny'],
                    'slice-offer_id' => ['level' => 'deny'],
                    'slice-os' => ['level' => 'deny'],
                    'slice-prelanding' => ['level' => 'deny'],
                    'slice-smart_id' => ['level' => 'deny'],
                    'slice-sub1' => ['level' => 'deny'],
                    'slice-sub2' => ['level' => 'deny'],
                    'slice-trafficback_reason' => ['level' => 'deny'],
                    'stats-export' => ['level' => 'deny'],
                    'view-custom' => ['level' => 'deny'],
                    'view-kpi' => ['level' => 'deny'],
                    'view-retention-rate' => ['level' => 'deny'],
                ],
                'users' => [
                    'entity-account-manager' => [
                        'level' => 'deny',
                        'exceptions' => ['strings' => []],
                    ],
                    'entity-advertiser' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-affiliate' => ['level' => 'deny', 'exceptions' => ['ints' => []]],
                    'entity-affiliate-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-common-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-preset' => ['level' => 'deny'],
                    'view-users' => ['level' => 'deny'],
                ],
            ],
            'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
        ];

        static::$permissions = [
            'automation' => ['affise-checker' => ['level' => 'deny']],
            'general' => ['marketplace' => ['level' => 'read'], 'settings' => ['level' => 'deny']],
            'notificator' => [
                'client-subscription' => ['level' => 'write'],
                'transport-configuration' => ['level' => 'write'],
                'user-subscription' => ['level' => 'write'],
            ],
            'stats' => [
                'affiliate-postback' => ['level' => 'read'],
                'clicks-list' => ['level' => 'read'],
                'comparison-report' => ['level' => 'read'],
                'conversions-export' => ['level' => 'read'],
                'conversions-import' => ['level' => 'write'],
                'conversions-list' => ['level' => 'read'],
                'entity-account-manager' => [
                    'level' => 'read',
                    'default_level' => 'read',
                    'exceptions' => ['strings' => []],
                ],
                'entity-affiliate-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                'referral' => ['level' => 'deny'],
                'server-postback' => ['level' => 'read'],
                'slice-account_manager_id' => ['level' => 'deny'],
                'slice-advertiser_id' => ['level' => 'deny'],
                'slice-affiliate_id' => ['level' => 'read'],
                'slice-affiliate_manager_id' => ['level' => 'deny'],
                'slice-browser' => ['level' => 'deny'],
                'slice-city' => ['level' => 'read'],
                'slice-connection-type' => ['level' => 'deny'],
                'slice-country' => ['level' => 'read'],
                'slice-day' => ['level' => 'read'],
                'slice-device' => ['level' => 'read'],
                'slice-goal' => ['level' => 'read'],
                'slice-landing' => ['level' => 'deny'],
                'slice-mobile-carrier' => ['level' => 'deny'],
                'slice-offer_id' => ['level' => 'read'],
                'slice-os' => ['level' => 'read'],
                'slice-prelanding' => ['level' => 'deny'],
                'slice-smart_id' => ['level' => 'deny'],
                'slice-sub1' => ['level' => 'deny'],
                'slice-sub2' => ['level' => 'deny'],
                'slice-trafficback_reason' => ['level' => 'read'],
                'stats-export' => ['level' => 'read'],
                'view-custom' => ['level' => 'read'],
                'view-kpi' => ['level' => 'deny'],
                'view-retention-rate' => ['level' => 'deny'],
            ],
            'users' => [
                'entity-account-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                'entity-advertiser' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                'entity-affiliate' => ['level' => 'deny', 'exceptions' => ['ints' => []]],
                'entity-affiliate-manager' => ['level' => 'write', 'exceptions' => ['strings' => []]],
                'entity-common-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                'entity-preset' => ['level' => 'deny'],
                'view-users' => ['level' => 'deny'],
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testUpdateUserPermissionsFailsWhenDataIsEmpty(): void
    {
        $userProvider = new UserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $userProvider->updateUserPermissions('5fe360de2d5119ff779037fe', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testUpdateUserPermissionsDataAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $data = [
            'permissions' => static::$permissions,
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.1/user/5fe360de2d5119ff779037fe/permissions', $data)
            ->willReturn(
                [
                    'status' => 1,
                    'permissions' => static::$attributes,
                ]
            );

        $userProvider = new UserProvider($transport);
        $userProvider->updateUserPermissions('5fe360de2d5119ff779037fe', $data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testUpdateUserPermissionsResponse(): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->method('post')
            ->willReturn([
                'status' => 1,
                'permissions' => $attributes,
            ]);

        $userProvider = new UserProvider($transport);
        $response = $userProvider->updateUserPermissions('5fe360de2d5119ff779037fe', [
            'permissions' => static::$permissions,
        ]);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(UpdateUserPermissionsDto::class, $response->getData());
        $this->assertEquals(new UpdateUserPermissionsDto($attributes), $response->getData());
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
    public function testUpdateUserPermissionsFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $userProvider = new UserProvider($transport);

        $this->expectException($exceptionClass);

        $userProvider->updateUserPermissions('5fe360de2d5119ff779037fe', [
            'permissions' => static::$permissions,
        ]);
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
