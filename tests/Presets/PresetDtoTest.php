<?php

declare(strict_types=1);

namespace Affise\Sdk\Presets;

use PHPUnit\Framework\TestCase;

/**
 * Class PresetDtoTest
 */
class PresetDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
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

    public function testGetId(): void
    {
        $getListOfPresetsDto = new PresetDto(static::$requiredAttributes);

        $this->assertEquals('5f51755a535bac2217eb7619', $getListOfPresetsDto->getId());
    }

    public function testGetName(): void
    {
        $getListOfPresetsDto = new PresetDto(static::$requiredAttributes);

        $this->assertEquals('Test affiliate_manager 4', $getListOfPresetsDto->getName());
    }

    public function testGetPermissions(): void
    {
        $getListOfPresetsDto = new PresetDto(static::$requiredAttributes);

        $this->assertEquals(
            [
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
            $getListOfPresetsDto->getPermissions()
        );
    }

    public function testGetCreatedAt(): void
    {
        $getListOfPresetsDto = new PresetDto(static::$requiredAttributes);

        $this->assertEquals('2020-09-03T22:59:38Z', $getListOfPresetsDto->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        $getListOfPresetsDto = new PresetDto(static::$requiredAttributes);

        $this->assertEquals('2020-09-03T22:59:38Z', $getListOfPresetsDto->getUpdatedAt());
    }
}
