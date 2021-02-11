<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class SupplierDtoTest
 */
class SupplierDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '5f059cf72bdea5690c593e53',
            'title' => 'WC',
        ];
    }

    public function testGetId(): void
    {
        $supplierDto = new SupplierDto(static::$requiredAttributes);

        $this->assertEquals('5f059cf72bdea5690c593e53', $supplierDto->getId());
    }

    public function testGetTitle(): void
    {
        $supplierDto = new SupplierDto(static::$requiredAttributes);

        $this->assertEquals('WC', $supplierDto->getTitle());
    }
}
