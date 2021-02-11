<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class DeletePartnerPostbackDtoTest
*/
class DeletePartnerPostbackDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 960,
            'url' => 'http://affise.com',
            'offer_id' => '4',
            'status' => 'confirmed',
            'created' => '2017-06-20 02:17:58',
            'updated_at' => '2017-06-20 02:17:58',
            'forced' => '0',
            'pid' => '1',
        ];
    }

    public function testConstructWithRequiredAttributes(): void
    {
        $deletePartnerPostbackDto = new DeletePartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(960, $deletePartnerPostbackDto->getId());
        $this->assertEquals('http://affise.com', $deletePartnerPostbackDto->getUrl());
        $this->assertEquals('4', $deletePartnerPostbackDto->getOfferId());
        $this->assertEquals('confirmed', $deletePartnerPostbackDto->getStatus());
        $this->assertEquals('2017-06-20 02:17:58', $deletePartnerPostbackDto->getCreated());
        $this->assertEquals('2017-06-20 02:17:58', $deletePartnerPostbackDto->getUpdatedAt());
        $this->assertEquals('0', $deletePartnerPostbackDto->getForced());
        $this->assertEquals('1', $deletePartnerPostbackDto->getPid());
    }

    public function testGetGoal(): void
    {
        $deletePartnerPostbackDto = new DeletePartnerPostbackDto(static::$requiredAttributes + ['goal' => 'laboriosam']);
        $this->assertEquals('laboriosam', $deletePartnerPostbackDto->getGoal());

        $deletePartnerPostbackDto = new DeletePartnerPostbackDto(static::$requiredAttributes + ['goal' => null]);
        $this->assertNull($deletePartnerPostbackDto->getGoal());

        $deletePartnerPostbackDto = new DeletePartnerPostbackDto(static::$requiredAttributes);
        $this->assertNull($deletePartnerPostbackDto->getGoal());
    }
}
