<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class SourceAddDtoTest
 */
class SourceAddDtoTest extends TestCase
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
        $sourceAddDto = new SourceAddDto(static::$requiredAttributes);

        $this->assertEquals('api-test-en-3', $sourceAddDto->getTitle());
    }

    public function testGetTitleLang(): void
    {
        $sourceAddDto = new SourceAddDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                'en' => 'api-test-en-3',
                'ru' => 'api-test-ru-3',
                'es' => 'api-test-es-2',
                'ka' => 'api-test-ka-2',
                'vi' => 'api-test-vi-3',
            ],
            $sourceAddDto->getTitleLang()
        );
    }

    public function testGetId(): void
    {
        $sourceAddDto = new SourceAddDto(static::$requiredAttributes);

        $this->assertEquals('5b7e6d350f0e5a001c7bb4d5', $sourceAddDto->getId());
    }
}
