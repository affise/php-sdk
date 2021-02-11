<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use PHPUnit\Framework\TestCase;

/**
 * Class NewsDtoTest
 */
class NewsDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            '_id' => ['$id' => '57a4914f3b7d9bbd358b45b6'],
            'title' => 'Title news',
            'small_desc' => 'laborum',
            'desc' => 'ut',
            'status' => 1,
            'created_at' => ['sec' => 1470402895, 'usec' => 891000],
        ];
    }

    public function testGetId(): void
    {
        $newsDto = new NewsDto(static::$requiredAttributes);

        $this->assertEquals('57a4914f3b7d9bbd358b45b6', $newsDto->getId());
    }

    public function testGetTitle(): void
    {
        $newsDto = new NewsDto(static::$requiredAttributes);

        $this->assertEquals('Title news', $newsDto->getTitle());
    }

    public function testGetSmallDesc(): void
    {
        $newsDto = new NewsDto(static::$requiredAttributes);

        $this->assertEquals('laborum', $newsDto->getSmallDesc());
    }

    public function testGetDesc(): void
    {
        $newsDto = new NewsDto(static::$requiredAttributes);

        $this->assertEquals('ut', $newsDto->getDesc());
    }

    public function testGetStatus(): void
    {
        $newsDto = new NewsDto(static::$requiredAttributes);

        $this->assertEquals(1, $newsDto->getStatus());
    }

    public function testGetCreatedAt(): void
    {
        $newsDto = new NewsDto(static::$requiredAttributes);

        $this->assertEquals(['sec' => 1470402895, 'usec' => 891000], $newsDto->getCreatedAt());
    }
}
