<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class ByReferralPaymentsDtoTest
 */
class ByReferralPaymentsDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'total' => [
                'count' => '0',
                'sum_revenue' => '',
                'sum_revenue_pay' => '',
                'sum_revenue_paid' => '',
                'sum_revenue_hold' => '',
            ],
        ];
    }

    public function testGetTotal(): void
    {
        $byReferralPaymentsDto = new ByReferralPaymentsDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'count' => '0',
                'sum_revenue' => '',
                'sum_revenue_pay' => '',
                'sum_revenue_paid' => '',
                'sum_revenue_hold' => '',
            ],
            $byReferralPaymentsDto->getTotal()
        );
    }
}
