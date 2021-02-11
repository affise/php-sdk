<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use Affise\Sdk\User\Role;
use Affise\Sdk\User\UserDto;
use PHPUnit\Framework\TestCase;

/**
 * Class PartnerDtoTest
 */
class PartnerDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 2,
            'email' => 'olga86@example.org',
            'login' => 'Yvette Michael',
            'name' => 'Yvette Michael',
            'manager' => [
                'id' => '5ee38817fec6270c4804061d',
                'first_name' => 'Ivan',
                'last_name' => 'Petrovich',
                'email' => 'testadmin@gmail.com',
                'api_key' => '4bd66dda264e195f34b5b319f7abe4a0',
                'roles' => [Role::ROLE_ADMIN],
                'type' => 'client',
            ],
        ];
    }

    public function testGetId(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals(2, $partnerDto->getId());
    }

    public function testGetEmail(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('olga86@example.org', $partnerDto->getEmail());
    }

    public function testGetLogin(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('Yvette Michael', $partnerDto->getLogin());
    }

    public function testGetName(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);

        $this->assertEquals('Yvette Michael', $partnerDto->getName());
    }

    public function testGetManager(): void
    {
        $partnerDto = new PartnerDto(static::$requiredAttributes);
        $this->assertEquals(
            new UserDto(
                [
                    'id' => '5ee38817fec6270c4804061d',
                    'first_name' => 'Ivan',
                    'last_name' => 'Petrovich',
                    'email' => 'testadmin@gmail.com',
                    'api_key' => '4bd66dda264e195f34b5b319f7abe4a0',
                    'roles' => [Role::ROLE_ADMIN],
                    'type' => 'client',
                ]
            ),
            $partnerDto->getManager()
        );
    }
}
