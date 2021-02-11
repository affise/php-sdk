<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class EditPartnerPostbackDtoTest
*/
class EditPartnerPostbackDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 960,
            'url' => 'http://affise.com',
            'status' => 'confirmed',
            'created' => '2017-06-20 02:17:58',
            'updated_at' => '2017-06-20 02:17:58',
            'forced' => '0',
            'pid' => '1',
        ];
    }

    public function testConstructWithRequiredAttributes(): void
    {
        $editPartnerPostbackDto = new EditPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(960, $editPartnerPostbackDto->getId());
        $this->assertEquals('http://affise.com', $editPartnerPostbackDto->getUrl());
        $this->assertEquals('confirmed', $editPartnerPostbackDto->getStatus());
        $this->assertEquals('2017-06-20 02:17:58', $editPartnerPostbackDto->getCreated());
        $this->assertEquals('2017-06-20 02:17:58', $editPartnerPostbackDto->getUpdatedAt());
        $this->assertEquals('0', $editPartnerPostbackDto->getForced());
        $this->assertEquals('1', $editPartnerPostbackDto->getPid());
    }

    public function testGetGoal(): void
    {
        $editPartnerPostbackDto = new EditPartnerPostbackDto(static::$requiredAttributes + ['goal' => 'optio']);
        $this->assertEquals('optio', $editPartnerPostbackDto->getGoal());

        $editPartnerPostbackDto = new EditPartnerPostbackDto(static::$requiredAttributes + ['goal' => null]);
        $this->assertNull($editPartnerPostbackDto->getGoal());

        $editPartnerPostbackDto = new EditPartnerPostbackDto(static::$requiredAttributes);
        $this->assertNull($editPartnerPostbackDto->getGoal());
    }
}
