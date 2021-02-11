<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class AffiliatePostbacksListDtoTest
*/
class AffiliatePostbacksListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 8,
            'url' => 'http://affise.com',
            'offer_id' => '17',
            'status' => 'pending',
            'goal' => '1',
            'created' => '2018-01-30 18:31:52',
            'forced' => '0',
        ];
    }

    public function testConstructWithRequiredAttributes(): void
    {
        $affiliatePostbacksListDto = new AffiliatePostbacksListDto(static::$requiredAttributes);

        $this->assertEquals(8, $affiliatePostbacksListDto->getId());
        $this->assertEquals('http://affise.com', $affiliatePostbacksListDto->getUrl());
        $this->assertEquals('17', $affiliatePostbacksListDto->getOfferId());
        $this->assertEquals('pending', $affiliatePostbacksListDto->getStatus());
        $this->assertEquals('1', $affiliatePostbacksListDto->getGoal());
        $this->assertEquals('2018-01-30 18:31:52', $affiliatePostbacksListDto->getCreated());
        $this->assertEquals('0', $affiliatePostbacksListDto->getForced());
    }
}
