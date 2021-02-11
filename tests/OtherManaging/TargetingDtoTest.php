<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class TargetingDtoTest
 */
class TargetingDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'country' => ['allow' => [], 'deny' => []],
            'region' => ['allow' => [], 'deny' => []],
            'city' => ['allow' => [], 'deny' => []],
            'os' => ['allow' => [], 'deny' => []],
            'isp' => ['allow' => [], 'deny' => []],
            'ip' => ['allow' => [], 'deny' => []],
            'browser' => ['allow' => [], 'deny' => []],
            'brand' => ['allow' => [], 'deny' => []],
            'device_type' => [],
            'connection' => [],
            'affiliate_id' => [],
            'sub' => ['allow' => [], 'deny' => [], 'deny_groups' => []],
            'url' => '',
            'block_proxy' => false,
        ];
    }

    public function testGetCountry(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getCountry());
    }

    public function testGetRegion(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getRegion());
    }

    public function testGetCity(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getCity());
    }

    public function testGetOs(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getOs());
    }

    public function testGetIsp(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getIsp());
    }

    public function testGetIp(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getIp());
    }

    public function testGetBrowser(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getBrowser());
    }

    public function testGetBrand(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => []], $targetingDto->getBrand());
    }

    public function testGetDeviceType(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals([], $targetingDto->getDeviceType());
    }

    public function testGetConnection(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals([], $targetingDto->getConnection());
    }

    public function testGetAffiliateId(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals([], $targetingDto->getAffiliateId());
    }

    public function testGetSub(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(['allow' => [], 'deny' => [], 'deny_groups' => []], $targetingDto->getSub());
    }

    public function testGetUrl(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals('', $targetingDto->getUrl());
    }

    public function testGetBlockProxy(): void
    {
        $targetingDto = new TargetingDto(static::$requiredAttributes);

        $this->assertEquals(false, $targetingDto->getBlockProxy());
    }
}
