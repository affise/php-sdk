<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class UpdateUserPermissionsDtoTest
 */
class UpdateUserPermissionsDtoTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstructWithEmptyAttributes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new UpdateUserPermissionsDto([]);
    }

    /**
     * @return void
     */
    public function testConstructWithRequiredAttributesOnly(): void
    {
        $permissions = [
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
        ];

        $updateUserPermissionsDto = new UpdateUserPermissionsDto([
            'id' => '5fe360de2d5119ff779037fe',
            'email' => 'tromp.stanton@example.com',
            'type' => 'common_manager',
            'first_name' => 'Trudie',
            'last_name' => 'Stehr',
            'contacts' => ['skype' => ''],
            'permissions' => $permissions,
            'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
        ]);

        $this->assertEquals('5fe360de2d5119ff779037fe', $updateUserPermissionsDto->getId());
        $this->assertEquals('tromp.stanton@example.com', $updateUserPermissionsDto->getEmail());
        $this->assertEquals('common_manager', $updateUserPermissionsDto->getType());
        $this->assertEquals('Trudie', $updateUserPermissionsDto->getFirstName());
        $this->assertEquals('Stehr', $updateUserPermissionsDto->getLastName());
        $this->assertEquals(['skype' => ''], $updateUserPermissionsDto->getContacts());
        $this->assertEquals($permissions, $updateUserPermissionsDto->getPermissions());
        $this->assertNull($updateUserPermissionsDto->getWorkHours());
        $this->assertEquals('b2018c322280b3e12b29366fc629d7a1', $updateUserPermissionsDto->getApiKey());
        $this->assertNull($updateUserPermissionsDto->getCreatedAt());
        $this->assertNull($updateUserPermissionsDto->getUpdatedAt());
    }

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $persmissions = [
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
        ];

        $updateUserPermissionsDto = new UpdateUserPermissionsDto([
            'id' => '5fe360de2d5119ff779037fe',
            'email' => 'tromp.stanton@example.com',
            'type' => 'common_manager',
            'first_name' => 'Trudie',
            'last_name' => 'Stehr',
            'contacts' => ['skype' => ''],
            'permissions' => $persmissions,
            'work_hours' => '13:43 - 16:24',
            'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
            'created_at' => '2020-12-23T15:23:10Z',
            'updated_at' => '2020-12-24T20:02:54Z',
        ]);

        $this->assertEquals('5fe360de2d5119ff779037fe', $updateUserPermissionsDto->getId());
        $this->assertEquals('tromp.stanton@example.com', $updateUserPermissionsDto->getEmail());
        $this->assertEquals('common_manager', $updateUserPermissionsDto->getType());
        $this->assertEquals('Trudie', $updateUserPermissionsDto->getFirstName());
        $this->assertEquals('Stehr', $updateUserPermissionsDto->getLastName());
        $this->assertEquals(['skype' => ''], $updateUserPermissionsDto->getContacts());
        $this->assertEquals($persmissions, $updateUserPermissionsDto->getPermissions());
        $this->assertEquals('13:43 - 16:24', $updateUserPermissionsDto->getWorkHours());
        $this->assertEquals('b2018c322280b3e12b29366fc629d7a1', $updateUserPermissionsDto->getApiKey());
        $this->assertEquals('2020-12-23T15:23:10Z', $updateUserPermissionsDto->getCreatedAt());
        $this->assertEquals('2020-12-24T20:02:54Z', $updateUserPermissionsDto->getUpdatedAt());
    }
}
