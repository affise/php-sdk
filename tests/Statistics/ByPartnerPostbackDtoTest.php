<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class ByPartnerPostbackDtoTest
 */
class ByPartnerPostbackDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            '_id' => ['$id' => '5fa924caeaad4f25d8f9bf52'],
            'date' => ['sec' => 1604920521, 'usec' => 5628768000],
            'pid' => 12,
            'lead_id' => '5fa9240b125d99000173f135',
            'http_code' => 200,
            'postback_url' => 'http://affise.com',
            'offer_id' => 71,
            'goal' => '1',
            'status' => 1,
            'payouts' => 3.75,
            'revenue' => 4.25,
            'currency' => 2,
        ];
    }

    public function testGetId(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals('5fa924caeaad4f25d8f9bf52', $byPartnerPostbackDto->getId());
    }

    public function testGetDate(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(['sec' => 1604920521, 'usec' => 5628768000], $byPartnerPostbackDto->getDate());
    }

    public function testGetPid(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(12, $byPartnerPostbackDto->getPid());
    }

    public function testGetLeadId(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals('5fa9240b125d99000173f135', $byPartnerPostbackDto->getLeadId());
    }

    public function testGetHttpCode(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(200, $byPartnerPostbackDto->getHttpCode());
    }

    public function testGetPostbackUrl(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $byPartnerPostbackDto->getPostbackUrl());
    }

    public function testGetOfferId(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(71, $byPartnerPostbackDto->getOfferId());
    }

    public function testGetGoal(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals('1', $byPartnerPostbackDto->getGoal());
    }

    public function testGetStatus(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(1, $byPartnerPostbackDto->getStatus());
    }

    public function testGetPayouts(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(3.75, $byPartnerPostbackDto->getPayouts());
    }

    public function testGetRevenue(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(4.25, $byPartnerPostbackDto->getRevenue());
    }

    public function testGetCurrency(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);

        $this->assertEquals(2, $byPartnerPostbackDto->getCurrency());
    }

    public function testGetGet(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(
            static::$requiredAttributes + ['_get' => ['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8']]
        );
        $this->assertEquals(['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8'], $byPartnerPostbackDto->getGet());

        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes + ['_get' => null]);
        $this->assertEmpty($byPartnerPostbackDto->getGet());

        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);
        $this->assertEmpty($byPartnerPostbackDto->getGet());
    }

    public function testGetPost(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(
            static::$requiredAttributes + ['_post' => ['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8']]
        );
        $this->assertEquals(['clickid' => 'b46e3cc99b5a49b782b85cc6841855e8'], $byPartnerPostbackDto->getPost());

        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes + ['_post' => null]);
        $this->assertEmpty($byPartnerPostbackDto->getPost());

        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);
        $this->assertEmpty($byPartnerPostbackDto->getPost());
    }

    public function testGetJobId(): void
    {
        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes + ['job_id' => 'vitae']);
        $this->assertEquals('vitae', $byPartnerPostbackDto->getJobId());

        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes + ['job_id' => null]);
        $this->assertNull($byPartnerPostbackDto->getJobId());

        $byPartnerPostbackDto = new ByPartnerPostbackDto(static::$requiredAttributes);
        $this->assertNull($byPartnerPostbackDto->getJobId());
    }
}
