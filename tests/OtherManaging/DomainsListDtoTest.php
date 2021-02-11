<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class DomainsListDtoTest
 */
class DomainsListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 1,
            'url' => 'http://affise.com',
            'use_https' => false,
        ];
    }

    public function testGetId(): void
    {
        $domainsListDto = new DomainsListDto(static::$requiredAttributes);

        $this->assertEquals(1, $domainsListDto->getId());
    }

    public function testGetUrl(): void
    {
        $domainsListDto = new DomainsListDto(static::$requiredAttributes);

        $this->assertEquals('http://affise.com', $domainsListDto->getUrl());
    }

    public function testGetUseHttps(): void
    {
        $domainsListDto = new DomainsListDto(static::$requiredAttributes);

        $this->assertEquals(false, $domainsListDto->getUseHttps());
    }
}
