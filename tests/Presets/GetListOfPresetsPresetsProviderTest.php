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
use RuntimeException;

/**
 * Class GetListOfPresetsPresetsProviderTest
 */
class GetListOfPresetsPresetsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
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
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetListOfPresetsShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/presets', [])
            ->willReturn(
                [
                    'status' => 1,
                    'presets' => static::$attributes,
                ]
            );

        $presetsProvider = new PresetsProvider($transport);
        $presetsProvider->getListOfPresets([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetListOfPresetsWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'page' => 2,
            'limit' => 3,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/presets', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $presetsProvider = new PresetsProvider($transport);
        $presetsProvider->getListOfPresets($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetListOfPresetsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/presets')
            ->willReturn(
                [
                    'status' => 1,
                    'presets' => $attributes,
                ]
            );

        $presetsProvider = new PresetsProvider($transport);
        $response = $presetsProvider->getListOfPresets();

        $expectedData = array_map(fn(array $a) => new PresetDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
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
    public function testGetListOfPresetsFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $presetsProvider = new PresetsProvider($transport);

        $this->expectException($exceptionClass);

        $presetsProvider->getListOfPresets();
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
