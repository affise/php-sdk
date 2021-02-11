<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use PHPUnit\Framework\TestCase;

/**
 * Class UserDtoTest
 */
class UserDtoTest extends TestCase
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
        $usersListDto = new UserDto(static::$requiredAttributes + ['last_name' => 'Petrovich']);
        $this->assertEquals('Petrovich', $usersListDto->getLastName());

        $usersListDto = new UserDto(static::$requiredAttributes + ['last_name' => null]);
        $this->assertNull($usersListDto->getLastName());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getLastName());
    }

    public function testGetWorkHours(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['work_hours' => '10:00 - 19:00',]);
        $this->assertEquals('10:00 - 19:00', $usersListDto->getWorkHours());

        $usersListDto = new UserDto(static::$requiredAttributes + ['work_hours' => null]);
        $this->assertNull($usersListDto->getWorkHours());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getWorkHours());
    }

    public function testGetUpdatedAt(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['updated_at' => '2020-12-17 17:50:12']);
        $this->assertEquals('2020-12-17 17:50:12', $usersListDto->getUpdatedAt());

        $usersListDto = new UserDto(static::$requiredAttributes + ['updated_at' => null]);
        $this->assertNull($usersListDto->getUpdatedAt());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getUpdatedAt());
    }

    public function testGetRoles(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['roles' => [Role::ROLE_ADMIN, Role::ROLE_MANAGER_AFFILIATE]]);
        $this->assertEquals([Role::ROLE_ADMIN, Role::ROLE_MANAGER_AFFILIATE], $usersListDto->getRoles());

        $usersListDto = new UserDto(static::$requiredAttributes + ['roles' => null]);
        $this->assertNull($usersListDto->getRoles());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getRoles());
    }

    public function testGetCreatedAt(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['created_at' => '2020-06-25 15:43:26']);
        $this->assertEquals('2020-06-25 15:43:26', $usersListDto->getCreatedAt());

        $usersListDto = new UserDto(static::$requiredAttributes + ['created_at' => null]);
        $this->assertNull($usersListDto->getCreatedAt());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getCreatedAt());
    }

    public function testGetSkype(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['skype' => 'amet']);
        $this->assertEquals('amet', $usersListDto->getSkype());

        $usersListDto = new UserDto(static::$requiredAttributes + ['skype' => null]);
        $this->assertNull($usersListDto->getSkype());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getSkype());
    }

    public function testGetAvatar(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['avatar' => 'dGVzdA==']);
        $this->assertEquals('dGVzdA==', $usersListDto->getAvatar());

        $usersListDto = new UserDto(static::$requiredAttributes + ['avatar' => null]);
        $this->assertNull($usersListDto->getAvatar());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getAvatar());
    }

    public function testGetEmail(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['email' => 'testadmin@gmail.com']);
        $this->assertEquals('testadmin@gmail.com', $usersListDto->getEmail());

        $usersListDto = new UserDto(static::$requiredAttributes + ['email' => null]);
        $this->assertNull($usersListDto->getEmail());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getEmail());
    }

    public function testGetFirstName(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['first_name' => 'Ivan']);
        $this->assertEquals('Ivan', $usersListDto->getFirstName());

        $usersListDto = new UserDto(static::$requiredAttributes + ['first_name' => null]);
        $this->assertNull($usersListDto->getFirstName());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getFirstName());
    }

    public function testGetId(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes);

        $this->assertEquals('5ee38817fec6270c4804061d', $usersListDto->getId());
    }

    public function testGetLastLoginAt(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['last_login_at' => '2020-12-14 18:29:47']);
        $this->assertEquals('2020-12-14 18:29:47', $usersListDto->getLastLoginAt());

        $usersListDto = new UserDto(static::$requiredAttributes + ['last_login_at' => null]);
        $this->assertNull($usersListDto->getLastLoginAt());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getLastLoginAt());
    }

    public function testGetType(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['type' => 'client']);
        $this->assertEquals('client', $usersListDto->getType());

        $usersListDto = new UserDto(static::$requiredAttributes + ['type' => null]);
        $this->assertNull($usersListDto->getType());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getType());
    }

    public function testGetApiKey(): void
    {
        $usersListDto = new UserDto(static::$requiredAttributes + ['api_key' => '4bd66dda264e195f34b5b319f7abe4a0']);
        $this->assertEquals('4bd66dda264e195f34b5b319f7abe4a0', $usersListDto->getApiKey());

        $usersListDto = new UserDto(static::$requiredAttributes + ['api_key' => null]);
        $this->assertNull($usersListDto->getApiKey());

        $usersListDto = new UserDto(static::$requiredAttributes);
        $this->assertNull($usersListDto->getApiKey());
    }
}
