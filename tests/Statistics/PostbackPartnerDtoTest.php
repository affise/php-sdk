<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class PostbackPartnerDtoTest
 */
class PostbackPartnerDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 610,
            'email' => 'aff@iliate.com',
            'login' => 'affiliate',
            'manager' => [
                'id' => '5f72fc82afd0ba5d88c4bd00',
                'title' => 'Curtis Ross',
                'first_name' => '',
                'last_name' => '',
            ],
            'manager_id' => '5f72fc82afd0ba5d88c4bd00',
        ];
    }

    public function testGetId(): void
    {
        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes);

        $this->assertEquals(610, $postbackPartnerDto->getId());
    }

    public function testGetEmail(): void
    {
        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes);

        $this->assertEquals('aff@iliate.com', $postbackPartnerDto->getEmail());
    }

    public function testGetLogin(): void
    {
        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes);

        $this->assertEquals('affiliate', $postbackPartnerDto->getLogin());
    }

    public function testGetName(): void
    {
        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes + ['name' => 'test']);
        $this->assertEquals('test', $postbackPartnerDto->getName());

        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes + ['name' => null]);
        $this->assertNull($postbackPartnerDto->getName());

        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes);
        $this->assertNull($postbackPartnerDto->getName());
    }

    public function testGetTitle(): void
    {
        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes + ['title' => 'test']);
        $this->assertEquals('test', $postbackPartnerDto->getTitle());

        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes + ['title' => null]);
        $this->assertNull($postbackPartnerDto->getTitle());

        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes);
        $this->assertNull($postbackPartnerDto->getTitle());
    }

    public function testGetManager(): void
    {
        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes);

        $this->assertEquals(
            new AffiliateManagerDto(
                [
                    'id' => '5f72fc82afd0ba5d88c4bd00',
                    'title' => 'Curtis Ross',
                    'first_name' => '',
                    'last_name' => '',
                ]
            ),
            $postbackPartnerDto->getManager()
        );
    }

    public function testGetManagerId(): void
    {
        $postbackPartnerDto = new PostbackPartnerDto(static::$requiredAttributes);

        $this->assertEquals('5f72fc82afd0ba5d88c4bd00', $postbackPartnerDto->getManagerId());
    }
}

