<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class AddPartnerPostbackDtoTest
*/
class AddPartnerPostbackDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 960,
            'url' => 'http://affise.com',
            'status' => 'by_creating',
            'created' => '2017-06-20 02:17:58',
            'updated_at' => '2017-06-20 02:17:58',
            'forced' => '0',
            'pid' => '1',
        ];
    }

    public function testConstructWithRequiredAttributes(): void
    {
        $addPartnerPostbackDto = new AddPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(960, $addPartnerPostbackDto->getId());
        $this->assertEquals('http://affise.com', $addPartnerPostbackDto->getUrl());
        $this->assertEquals('by_creating', $addPartnerPostbackDto->getStatus());
        $this->assertEquals('2017-06-20 02:17:58', $addPartnerPostbackDto->getCreated());
        $this->assertEquals('2017-06-20 02:17:58', $addPartnerPostbackDto->getUpdatedAt());
        $this->assertEquals('0', $addPartnerPostbackDto->getForced());
        $this->assertEquals('1', $addPartnerPostbackDto->getPid());
    }

    public function testGetGoal(): void
    {
        $addPartnerPostbackDto = new AddPartnerPostbackDto(static::$requiredAttributes + ['goal' => 'vitae']);
        $this->assertEquals('vitae', $addPartnerPostbackDto->getGoal());

        $addPartnerPostbackDto = new AddPartnerPostbackDto(static::$requiredAttributes + ['goal' => null]);
        $this->assertNull($addPartnerPostbackDto->getGoal());

        $addPartnerPostbackDto = new AddPartnerPostbackDto(static::$requiredAttributes);
        $this->assertNull($addPartnerPostbackDto->getGoal());
    }
}
