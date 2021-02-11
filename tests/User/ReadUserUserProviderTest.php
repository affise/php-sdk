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
 * Class ReadUserUserProviderTest
 */
class ReadUserUserProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testReadUserResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            'id' => '5fe360de2d5119ff779037fe',
            'first_name' => 'Trudie',
            'last_name' => 'Stehr',
            'work_hours' => '18:21 - 12:16',
            'email' => 'tromp.stanton@example.com',
            'skype' => 'expedita',
            'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
            'roles' => ['ROLE_SECTION_STATS_COMMON'],
            'updated_at' => '2020-12-24T20:02:54Z',
            'created_at' => '2020-12-23T15:23:10Z',
            'last_login_at' => '2020-12-23T14:01:33+00:00',
            'type' => 'common_manager',
            'avatar' => 'dGVzdA==',
            'info' => 'commodi',
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
                    'entity-account-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-advertiser' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-affiliate' => ['level' => 'deny', 'exceptions' => ['ints' => []]],
                    'entity-affiliate-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-common-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-preset' => ['level' => 'deny'],
                    'view-users' => ['level' => 'deny'],
                ],
            ],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/user/5fe360de2d5119ff779037fe', [])
            ->willReturn(
                [
                    'status' => 1,
                    'user' => $attributes,
                ]
            );

        $userProvider = new UserProvider($transport);
        $response = $userProvider->readUser('5fe360de2d5119ff779037fe');

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(ReadUserDto::class, $response->getData());
        $this->assertEquals(new ReadUserDto($attributes), $response->getData());
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
    public function testReadUserFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $userProvider = new UserProvider($transport);

        $this->expectException($exceptionClass);

        $userProvider->readUser('5fe360de2d5119ff779037fe');
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
