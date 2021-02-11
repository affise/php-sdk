<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class SourceRemoveDtoTest
 */
class SourceRemoveDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'title' => 'api-test-en-3',
            'title_lang' => [
                'en' => 'api-test-en-3',
                'ru' => 'api-test-ru-3',
                'es' => 'api-test-es-2',
                'ka' => 'api-test-ka-2',
                'vi' => 'api-test-vi-3',
            ],
            'id' => '5b7e6d350f0e5a001c7bb4d5',
        ];
    }

    public function testGetTitle(): void
    {
        $sourceRemoveDto = new SourceRemoveDto(static::$requiredAttributes);

        $this->assertEquals('api-test-en-3', $sourceRemoveDto->getTitle());
    }

    public function testGetTitleLang(): void
    {
        $sourceRemoveDto = new SourceRemoveDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'en' => 'api-test-en-3',
                'ru' => 'api-test-ru-3',
                'es' => 'api-test-es-2',
                'ka' => 'api-test-ka-2',
                'vi' => 'api-test-vi-3',
            ],
            $sourceRemoveDto->getTitleLang()
        );
    }

    public function testGetId(): void
    {
        $sourceRemoveDto = new SourceRemoveDto(static::$requiredAttributes);

        $this->assertEquals('5b7e6d350f0e5a001c7bb4d5', $sourceRemoveDto->getId());
    }
}
