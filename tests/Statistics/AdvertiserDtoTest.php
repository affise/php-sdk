<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class AdvertiserDtoTest
 */
class AdvertiserDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5b5f415035752723008b456a',
            'title' => 'Text supplier 2',
        ];
    }

    public function testGetId(): void
    {
        $advertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals('5b5f415035752723008b456a', $advertiserDto->getId());
    }

    public function testGetTitle(): void
    {
        $advertiserDto = new AdvertiserDto(static::$requiredAttributes);

        $this->assertEquals('Text supplier 2', $advertiserDto->getTitle());
    }
}
