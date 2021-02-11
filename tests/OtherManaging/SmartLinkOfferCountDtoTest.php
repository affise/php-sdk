<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class SmartLinkOfferCountDtoTest
 */
class SmartLinkOfferCountDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'count' => 2,
        ];
    }

    public function testGetCount(): void
    {
        $smartLinkOfferCountDto = new SmartLinkOfferCountDto(static::$requiredAttributes);

        $this->assertEquals(2, $smartLinkOfferCountDto->getCount());
    }
}
