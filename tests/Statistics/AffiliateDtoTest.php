<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class AffiliateDtoTest
 */
class AffiliateDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 610,
            'email' => 'aff@iliate.com',
            'login' => 'affiliate',
            'name' => '',
        ];
    }

    public function testGetId(): void
    {
        $affiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals(610, $affiliateDto->getId());
    }

    public function testGetEmail(): void
    {
        $affiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('aff@iliate.com', $affiliateDto->getEmail());
    }

    public function testGetLogin(): void
    {
        $affiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('affiliate', $affiliateDto->getLogin());
    }

    public function testGetName(): void
    {
        $affiliateDto = new AffiliateDto(static::$requiredAttributes);

        $this->assertEquals('', $affiliateDto->getName());
    }
}

