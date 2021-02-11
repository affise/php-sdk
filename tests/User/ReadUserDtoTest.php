<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use PHPUnit\Framework\TestCase;

/**
 * Class ReadUserDtoTest
 */
class ReadUserDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5ee38817fec6270c4804061d',
        ];
    }

    public function testGetLastName(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['last_name' => 'Petrovich']);
        $this->assertEquals('Petrovich', $readUserDto->getLastName());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['last_name' => null]);
        $this->assertNull($readUserDto->getLastName());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getLastName());
    }

    public function testGetWorkHours(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['work_hours' => '10:00 - 19:00',]);
        $this->assertEquals('10:00 - 19:00', $readUserDto->getWorkHours());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['work_hours' => null]);
        $this->assertNull($readUserDto->getWorkHours());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getWorkHours());
    }

    public function testGetUpdatedAt(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['updated_at' => '2020-12-17 17:50:12']);
        $this->assertEquals('2020-12-17 17:50:12', $readUserDto->getUpdatedAt());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['updated_at' => null]);
        $this->assertNull($readUserDto->getUpdatedAt());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getUpdatedAt());
    }

    public function testGetRoles(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['roles' => [Role::ROLE_ADMIN, Role::ROLE_MANAGER_AFFILIATE]]);
        $this->assertEquals([Role::ROLE_ADMIN, Role::ROLE_MANAGER_AFFILIATE], $readUserDto->getRoles());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['roles' => null]);
        $this->assertNull($readUserDto->getRoles());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getRoles());
    }

    public function testGetCreatedAt(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['created_at' => '2020-06-25 15:43:26']);
        $this->assertEquals('2020-06-25 15:43:26', $readUserDto->getCreatedAt());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['created_at' => null]);
        $this->assertNull($readUserDto->getCreatedAt());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getCreatedAt());
    }

    public function testGetSkype(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['skype' => 'amet']);
        $this->assertEquals('amet', $readUserDto->getSkype());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['skype' => null]);
        $this->assertNull($readUserDto->getSkype());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getSkype());
    }

    public function testGetAvatar(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['avatar' => 'dGVzdA==']);
        $this->assertEquals('dGVzdA==', $readUserDto->getAvatar());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['avatar' => null]);
        $this->assertNull($readUserDto->getAvatar());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getAvatar());
    }

    public function testGetEmail(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['email' => 'testadmin@gmail.com']);
        $this->assertEquals('testadmin@gmail.com', $readUserDto->getEmail());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['email' => null]);
        $this->assertNull($readUserDto->getEmail());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getEmail());
    }

    public function testGetFirstName(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['first_name' => 'Ivan']);
        $this->assertEquals('Ivan', $readUserDto->getFirstName());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['first_name' => null]);
        $this->assertNull($readUserDto->getFirstName());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getFirstName());
    }

    public function testGetId(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes);

        $this->assertEquals('5ee38817fec6270c4804061d', $readUserDto->getId());
    }

    public function testGetLastLoginAt(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['last_login_at' => '2020-12-14 18:29:47']);
        $this->assertEquals('2020-12-14 18:29:47', $readUserDto->getLastLoginAt());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['last_login_at' => null]);
        $this->assertNull($readUserDto->getLastLoginAt());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getLastLoginAt());
    }

    public function testGetType(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['type' => 'client']);
        $this->assertEquals('client', $readUserDto->getType());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['type' => null]);
        $this->assertNull($readUserDto->getType());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getType());
    }

    public function testGetApiKey(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['api_key' => '4bd66dda264e195f34b5b319f7abe4a0']);
        $this->assertEquals('4bd66dda264e195f34b5b319f7abe4a0', $readUserDto->getApiKey());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['api_key' => null]);
        $this->assertNull($readUserDto->getApiKey());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getApiKey());
    }

    public function testGetInfo(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['info' => 'amet']);
        $this->assertEquals('amet', $readUserDto->getInfo());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['info' => null]);
        $this->assertNull($readUserDto->getInfo());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertNull($readUserDto->getInfo());
    }

    public function testGetContacts(): void
    {
        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['contacts' => ['skype' => 'test']]);
        $this->assertEquals(['skype' => 'test'], $readUserDto->getContacts());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['contacts' => null]);
        $this->assertEmpty($readUserDto->getContacts());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertEmpty($readUserDto->getContacts());
    }

    public function testGetPermissions(): void
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

        $readUserDto = new ReadUserDto(static::$requiredAttributes + compact('permissions'));
        $this->assertEquals($permissions, $readUserDto->getPermissions());

        $readUserDto = new ReadUserDto(static::$requiredAttributes + ['permissions' => null]);
        $this->assertEmpty($readUserDto->getPermissions());

        $readUserDto = new ReadUserDto(static::$requiredAttributes);
        $this->assertEmpty($readUserDto->getPermissions());
    }
}
