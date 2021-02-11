<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class LinkDtoTest
 */
class LinkDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'url' => 'http://affise.com',
            'postbacks' => [],
        ];
    }

    public function testGetUrl(): void
    {
        $linkDto = new LinkDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $linkDto->getUrl());
    }

    public function testGetPostbacks(): void
    {
        $linkDto = new LinkDto(static::$requiredAttributes);

        $this->assertEquals([], $linkDto->getPostbacks());
    }

    public function testGetId(): void
    {
        $linkDto = new LinkDto(static::$requiredAttributes + ['id' => 'e6741aa83c5361cca600811d6dbddef9e8e68d14']);
        $this->assertEquals('e6741aa83c5361cca600811d6dbddef9e8e68d14', $linkDto->getId());

        $linkDto = new LinkDto(static::$requiredAttributes + ['id' => null]);
        $this->assertNull($linkDto->getId());

        $linkDto = new LinkDto(static::$requiredAttributes);
        $this->assertNull($linkDto->getId());
    }

    public function testGetTitle(): void
    {
        $linkDto = new LinkDto(static::$requiredAttributes + ['title' => 'Dr.']);
        $this->assertEquals('Dr.', $linkDto->getTitle());

        $linkDto = new LinkDto(static::$requiredAttributes + ['title' => null]);
        $this->assertNull($linkDto->getTitle());

        $linkDto = new LinkDto(static::$requiredAttributes);
        $this->assertNull($linkDto->getTitle());
    }

    public function testGetHash(): void
    {
        $linkDto = new LinkDto(static::$requiredAttributes + ['hash' => '277e100a0b144301771a18dfd85f4b2db4eb9522']);
        $this->assertEquals('277e100a0b144301771a18dfd85f4b2db4eb9522', $linkDto->getHash());

        $linkDto = new LinkDto(static::$requiredAttributes + ['hash' => null]);
        $this->assertNull($linkDto->getHash());

        $linkDto = new LinkDto(static::$requiredAttributes);
        $this->assertNull($linkDto->getHash());
    }

    public function testGetCreated(): void
    {
        $linkDto = new LinkDto(static::$requiredAttributes + ['created' => 'quo']);
        $this->assertEquals('quo', $linkDto->getCreated());

        $linkDto = new LinkDto(static::$requiredAttributes + ['created' => null]);
        $this->assertNull($linkDto->getCreated());

        $linkDto = new LinkDto(static::$requiredAttributes);
        $this->assertNull($linkDto->getCreated());
    }
}
