<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class ChangePartnerApiKeyDtoTest
*/
class ChangePartnerApiKeyDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 1,
            'api_key' => '97366c88ad626fdf4c73687d2cae5394',
        ];
    }

    public function testConstructWithRequiredAttributes(): void
    {
        $changePartnerApiKeyDto = new ChangePartnerApiKeyDto(static::$requiredAttributes);

        $this->assertEquals(1, $changePartnerApiKeyDto->getId());
        $this->assertEquals('97366c88ad626fdf4c73687d2cae5394', $changePartnerApiKeyDto->getApiKey());
    }
}
