<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use PHPUnit\Framework\TestCase;

/**
* Class ChangeAffiliatePasswordDtoTest
*/
class ChangeAffiliatePasswordDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 10117,
            'password' => '5947c33371',
        ];
    }

    public function testConstructWithRequiredAttributes(): void
    {
        $changeAffiliatePasswordDto = new ChangeAffiliatePasswordDto(static::$requiredAttributes);

        $this->assertEquals(10117, $changeAffiliatePasswordDto->getId());
        $this->assertEquals('5947c33371', $changeAffiliatePasswordDto->getPassword());
    }
}
