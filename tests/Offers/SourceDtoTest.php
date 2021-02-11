<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use PHPUnit\Framework\TestCase;

/**
 * Class SourceDtoTest
 */
class SourceDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '51f531f53b7d9b1e0382f6d9',
            'title' => 'Web sites',
            'allowed' => 1,
        ];
    }

    public function testGetId(): void
    {
        $sourceDto = new SourceDto(static::$requiredAttributes);

        $this->assertEquals('51f531f53b7d9b1e0382f6d9', $sourceDto->getId());
    }

    public function testGetTitle(): void
    {
        $sourceDto = new SourceDto(static::$requiredAttributes);

        $this->assertEquals('Web sites', $sourceDto->getTitle());
    }

    public function testGetAllowed(): void
    {
        $sourceDto = new SourceDto(static::$requiredAttributes);

        $this->assertEquals(1, $sourceDto->getAllowed());
    }
}
