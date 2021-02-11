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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class CreatePresetPresetsProviderTest
 */
class CreatePresetPresetsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => '5f51755a535bac2217eb7619',
            'name' => 'Test affiliate_manager 4',
            'permissions' => [
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
                    'entity-account-manager' => ['level' => 'read', 'exceptions' => ['strings' => []]],
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
            ],
            'created_at' => '2020-09-03T22:59:38Z',
            'updated_at' => '2020-09-03T22:59:38Z',

        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testCreatePresetFailsWhenFiltersAreNotSet(): void
    {
        $presetsProvider = new PresetsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $presetsProvider->createPreset([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCreatePresetWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'name' => 'Test affiliate_manager 4',
            'permissions' => [
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
            ],
            'type' => 'affiliate_manager',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.1/presets', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $presetsProvider = new PresetsProvider($transport);
        $presetsProvider->createPreset($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCreatePresetFailsWhenNameIsNotPassed(): void
    {
        $presetsProvider = new PresetsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'name' is required");

        $presetsProvider->createPreset(
            [
                'permissions' => [
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
                ],
                'type' => 'affiliate_manager',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCreatePresetFailsWhenPermissionsIsNotPassed(): void
    {
        $presetsProvider = new PresetsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'permissions' is required");

        $presetsProvider->createPreset(
            [
                'name' => 'Test affiliate_manager 4',
                'type' => 'affiliate_manager',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCreatePresetFailsWhenTypeIsNotPassed(): void
    {
        $presetsProvider = new PresetsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'type' is required");

        $presetsProvider->createPreset(
            [
                'name' => 'Test affiliate_manager 4',
                'permissions' => [
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
                ],
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testCreatePresetResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.1/presets')
            ->willReturn(
                [
                    'status' => 1,
                    'preset' => $attributes,
                ]
            );

        $presetsProvider = new PresetsProvider($transport);
        $response = $presetsProvider->createPreset(
            [
                'name' => 'Test affiliate_manager 4',
                'permissions' => [
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
                ],
                'type' => 'affiliate_manager',
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(PresetDto::class, $response->getData());
        $this->assertEquals(new PresetDto($attributes), $response->getData());
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
    public function testCreatePresetFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $presetsProvider = new PresetsProvider($transport);

        $this->expectException($exceptionClass);

        $presetsProvider->createPreset(
            [
                'name' => 'Test affiliate_manager 4',
                'permissions' => [
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
                ],
                'type' => 'affiliate_manager',
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
