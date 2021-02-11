<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class SourceEditDtoTest
 */
class SourceEditDtoTest extends TestCase
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
        $sourceEditDto = new SourceEditDto(static::$requiredAttributes);

        $this->assertEquals('api-test-en-3', $sourceEditDto->getTitle());
    }

    public function testGetTitleLang(): void
    {
        $sourceEditDto = new SourceEditDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'en' => 'api-test-en-3',
                'ru' => 'api-test-ru-3',
                'es' => 'api-test-es-2',
                'ka' => 'api-test-ka-2',
                'vi' => 'api-test-vi-3',
            ],
            $sourceEditDto->getTitleLang()
        );
    }

    public function testGetId(): void
    {
        $sourceEditDto = new SourceEditDto(static::$requiredAttributes);

        $this->assertEquals('5b7e6d350f0e5a001c7bb4d5', $sourceEditDto->getId());
    }
}
