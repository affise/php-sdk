<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use PHPUnit\Framework\TestCase;

/**
 * Class AffiliateBalanceDtoTest
 */
class AffiliateBalanceDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'balance' => ['USD' => 0, 'EUR' => 0, 'RUB' => 16968],
            'hold' => ['USD' => 0, 'EUR' => 0, 'RUB' => 1234],
            'available' => ['USD' => 0, 'EUR' => 0, 'RUB' => 15734],
        ];
    }

    public function testGetBalance(): void
    {
        $affiliateBalanceDto = new AffiliateBalanceDto(static::$requiredAttributes);

        $this->assertEquals(['USD' => 0, 'EUR' => 0, 'RUB' => 16968], $affiliateBalanceDto->getBalance());
    }

    public function testGetHold(): void
    {
        $affiliateBalanceDto = new AffiliateBalanceDto(static::$requiredAttributes);

        $this->assertEquals(['USD' => 0, 'EUR' => 0, 'RUB' => 1234], $affiliateBalanceDto->getHold());
    }

    public function testGetAvailable(): void
    {
        $affiliateBalanceDto = new AffiliateBalanceDto(static::$requiredAttributes);

        $this->assertEquals(['USD' => 0, 'EUR' => 0, 'RUB' => 15734], $affiliateBalanceDto->getAvailable());
    }
}
