<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class LandingDtoTest
 */
class LandingDtoTest extends TestCase
{
    public function testGetId(): void
    {
        $landingDto = new LandingDto(['id' => 'test']);
        $this->assertEquals('test', $landingDto->getId());

        $landingDto = new LandingDto(['id' => 15]);
        $this->assertEquals(15, $landingDto->getId());
    }

    public function testGetUrl(): void
    {
        $landingDto = new LandingDto(['id' => 15, 'url' => 'http://affise.com']);
        $this->assertEquals('http://affise.com', $landingDto->getUrl());

        $landingDto = new LandingDto(['id' => 15, 'url' => null]);
        $this->assertNull($landingDto->getUrl());

        $landingDto = new LandingDto(['id' => 15]);
        $this->assertNull($landingDto->getUrl());
    }

    public function testGetTitle(): void
    {
        $landingDto = new LandingDto(['id' => 15, 'title' => 'test']);
        $this->assertEquals('test', $landingDto->getTitle());

        $landingDto = new LandingDto(['id' => 15, 'title' => null]);
        $this->assertNull($landingDto->getTitle());

        $landingDto = new LandingDto(['id' => 15]);
        $this->assertNull($landingDto->getTitle());
    }
}
