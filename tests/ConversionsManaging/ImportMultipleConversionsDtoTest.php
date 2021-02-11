<?php

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class ImportMultipleConversionsDtoTest
 */
class ImportMultipleConversionsDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'list' => [
                [
                    'offer' => 1000,
                    'pid' => 500,
                ],
            ],
        ];
    }

    public function testGetList(): void
    {
        $importMultipleConversionsDto = new ImportMultipleConversionsDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new ConversionDto(
                    [
                        'offer' => 1000,
                        'pid' => 500,
                    ]
                ),
            ],
            $importMultipleConversionsDto->getList()
        );
    }
}
