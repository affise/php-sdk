<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class AffiliateManagerDtoTest
 */
class AffiliateManagerDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5f9008bfafd0ba5d88c4dee8',
            'title' => 'Iren FSgdfddws',
            'first_name' => 'Iren FSgdfddws',
            'last_name' => '',
        ];
    }

    public function testGetId(): void
    {
        $affiliateManagerIdDto = new AffiliateManagerDto(static::$requiredAttributes);

        $this->assertEquals('5f9008bfafd0ba5d88c4dee8', $affiliateManagerIdDto->getId());
    }

    public function testGetTitle(): void
    {
        $affiliateManagerIdDto = new AffiliateManagerDto(static::$requiredAttributes);

        $this->assertEquals('Iren FSgdfddws', $affiliateManagerIdDto->getTitle());
    }

    public function testGetFirstName(): void
    {
        $affiliateManagerIdDto = new AffiliateManagerDto(static::$requiredAttributes);

        $this->assertEquals('Iren FSgdfddws', $affiliateManagerIdDto->getFirstName());
    }

    public function testGetLastName(): void
    {
        $affiliateManagerIdDto = new AffiliateManagerDto(static::$requiredAttributes);

        $this->assertEquals('', $affiliateManagerIdDto->getLastName());
    }
}
