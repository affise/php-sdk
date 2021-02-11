<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class SourcesDtoTest
 */
class SourcesDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '51f531f53b7d9b1e0382f6d9',
            'title' => 'Web sites',
            'title_lang' => ['ru' => 'веб сайты', 'en' => 'web sites', 'es' => ''],
            'allowed' => 0,
        ];
    }

    public function testGetId(): void
    {
        $sourcesDto = new SourcesDto(static::$requiredAttributes);

        $this->assertEquals('51f531f53b7d9b1e0382f6d9', $sourcesDto->getId());
    }

    public function testGetTitle(): void
    {
        $sourcesDto = new SourcesDto(static::$requiredAttributes);

        $this->assertEquals('Web sites', $sourcesDto->getTitle());
    }

    public function testGetTitleLang(): void
    {
        $sourcesDto = new SourcesDto(static::$requiredAttributes);

        $this->assertEquals(['ru' => 'веб сайты', 'en' => 'web sites', 'es' => ''], $sourcesDto->getTitleLang());
    }

    public function testGetAllowed(): void
    {
        $sourcesDto = new SourcesDto(static::$requiredAttributes);

        $this->assertEquals(0, $sourcesDto->getAllowed());
    }
}
