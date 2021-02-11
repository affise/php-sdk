<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class ByTrafficbackDtoTest
 */
class ByTrafficbackDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'slice' => ['trafficback_reason' => 'unknown-offer'],
            'traffic' => ['raw' => '0', 'uniq' => '0'],
            'actions' => [],
            'views' => 0,
            'ctr' => 0,
            'ecpm' => 0,
            'trafficback' => 2,
        ];
    }

    public function testGetSlice(): void
    {
        $byTrafficbackDto = new ByTrafficbackDto(static::$requiredAttributes);

        $this->assertEquals(['trafficback_reason' => 'unknown-offer'], $byTrafficbackDto->getSlice());
    }

    public function testGetTraffic(): void
    {
        $byTrafficbackDto = new ByTrafficbackDto(static::$requiredAttributes);

        $this->assertEquals(['raw' => '0', 'uniq' => '0'], $byTrafficbackDto->getTraffic());
    }

    public function testGetActions(): void
    {
        $byTrafficbackDto = new ByTrafficbackDto(static::$requiredAttributes);

        $this->assertEquals([], $byTrafficbackDto->getActions());
    }

    public function testGetViews(): void
    {
        $byTrafficbackDto = new ByTrafficbackDto(static::$requiredAttributes);

        $this->assertEquals(0, $byTrafficbackDto->getViews());
    }

    public function testGetCtr(): void
    {
        $byTrafficbackDto = new ByTrafficbackDto(static::$requiredAttributes);

        $this->assertEquals(0, $byTrafficbackDto->getCtr());
    }

    public function testGetEcpm(): void
    {
        $byTrafficbackDto = new ByTrafficbackDto(static::$requiredAttributes);

        $this->assertEquals(0, $byTrafficbackDto->getEcpm());
    }

    public function testGetTrafficback(): void
    {
        $byTrafficbackDto = new ByTrafficbackDto(static::$requiredAttributes);

        $this->assertEquals(2, $byTrafficbackDto->getTrafficback());
    }
}
