<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class AdvertiserManagerDtoTest
 */
class AdvertiserManagerDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '',
            'title' => 'Undefined',
            'first_name' => 'Undefined',
            'last_name' => '',
        ];
    }

    public function testGetId(): void
    {
        $advertiserManagerIdDto = new AdvertiserManagerDto(static::$requiredAttributes);

        $this->assertEquals('', $advertiserManagerIdDto->getId());
    }

    public function testGetTitle(): void
    {
        $advertiserManagerIdDto = new AdvertiserManagerDto(static::$requiredAttributes);

        $this->assertEquals('Undefined', $advertiserManagerIdDto->getTitle());
    }

    public function testGetFirstName(): void
    {
        $advertiserManagerIdDto = new AdvertiserManagerDto(static::$requiredAttributes);

        $this->assertEquals('Undefined', $advertiserManagerIdDto->getFirstName());
    }

    public function testGetLastName(): void
    {
        $advertiserManagerIdDto = new AdvertiserManagerDto(static::$requiredAttributes);

        $this->assertEquals('', $advertiserManagerIdDto->getLastName());
    }
}
