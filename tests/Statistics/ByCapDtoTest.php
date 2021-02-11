<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class ByCapDtoTest
 */
class ByCapDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'offer_id' => 10,
            'stats' => [
                [
                    'affiliate_type' => 'string',
                    'affiliates' => [],
                    'countries' => ['string'],
                    'country_type' => 'string',
                    'current_value' => 0,
                    'goal_stats' => [],
                    'goal_type' => 'string',
                    'goals' => [],
                    'id' => 'string',
                    'is_remaining' => true,
                    'reset_to_value' => 0,
                    'timeframe' => 'string',
                    'type' => 'string',
                    'value' => 0,
                ],
            ],
        ];
    }

    public function testGetOfferId(): void
    {
        $byCapDto = new ByCapDto(static::$requiredAttributes);

        $this->assertEquals(10, $byCapDto->getOfferId());
    }

    public function testGetStats(): void
    {
        $byCapDto = new ByCapDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new StatDto(
                    [
                        'affiliate_type' => 'string',
                        'affiliates' => [],
                        'countries' => ['string'],
                        'country_type' => 'string',
                        'current_value' => 0,
                        'goal_stats' => [],
                        'goal_type' => 'string',
                        'goals' => [],
                        'id' => 'string',
                        'is_remaining' => true,
                        'reset_to_value' => 0,
                        'timeframe' => 'string',
                        'type' => 'string',
                        'value' => 0,
                    ]
                ),
            ],
            $byCapDto->getStats()
        );
    }
}
