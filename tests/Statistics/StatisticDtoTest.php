<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class StatisticDtoTest
 */
class StatisticDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'slice' => ['year' => 2020, 'month' => 12, 'day' => 20],
            'traffic' => ['raw' => '3', 'uniq' => '3'],
            'actions' => [
                'total' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'confirmed' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'pending' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'declined' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'not_found' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'hold' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
            ],
            'views' => 0,
            'ctr' => 0.15,
            'ecpm' => 0.35,
            'cr' => ['total' => 0, 'confirmed' => 0, 'pending' => 0, 'declined' => 0, 'not_found' => 0, 'hold' => 0],
            'ratio' => '1:NaN',
            'epc' => 0.75,
        ];
    }

    public function testGetSlice(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(
            ['year' => 2020, 'month' => 12, 'day' => 20],
            $statisticDto->getSlice()
        );
    }

    public function testGetTraffic(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(['raw' => '3', 'uniq' => '3'], $statisticDto->getTraffic());
    }

    public function testGetActions(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'total' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'confirmed' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'pending' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'declined' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'not_found' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
                'hold' => ['charge' => 0, 'earning' => 0, 'null' => 0, 'revenue' => 0, 'count' => 0],
            ],
            $statisticDto->getActions()
        );
    }

    public function testGetViews(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(0, $statisticDto->getViews());
    }

    public function testGetCtr(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(0.15, $statisticDto->getCtr());
    }

    public function testGetEcpm(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(0.35, $statisticDto->getEcpm());
    }

    public function testGetCr(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(
            ['total' => 0, 'confirmed' => 0, 'pending' => 0, 'declined' => 0, 'not_found' => 0, 'hold' => 0],
            $statisticDto->getCr()
        );
    }

    public function testGetRatio(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals('1:NaN', $statisticDto->getRatio());
    }

    public function testGetEpc(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes);

        $this->assertEquals(0.75, $statisticDto->getEpc());
    }

    public function testGetTrafficback(): void
    {
        $statisticDto = new StatisticDto(static::$requiredAttributes + ['trafficback' => 2]);
        $this->assertEquals(2, $statisticDto->getTrafficback());

        $statisticDto = new StatisticDto(static::$requiredAttributes + ['trafficback' => null]);
        $this->assertNull($statisticDto->getTrafficback());

        $statisticDto = new StatisticDto(static::$requiredAttributes);
        $this->assertNull($statisticDto->getTrafficback());
    }
}

