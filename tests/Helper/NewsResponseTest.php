<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use Affise\Sdk\AffiliateMethods\NewsDto;
use PHPUnit\Framework\TestCase;

/**
 * Class NewsResponseTest
 */
class NewsResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetItems(): void
    {
        $news = [
            '57a4914f3b7d9bbd358b45b6' => new NewsDto([
                '_id' => ['$id' => '57a4914f3b7d9bbd358b45b6'],
                'title' => 'Title news',
                'small_desc' => 'animi',
                'desc' => 'voluptas',
                'status' => 1,
                'created_at' => ['sec' => 1470402895, 'usec' => 891000],
            ]),
            '57a4914f3b7d9bbd358b45b7' => new NewsDto([
                '_id' => ['$id' => '57a4914f3b7d9bbd358b45b7'],
                'title' => 'Title news',
                'small_desc' => 'animi',
                'desc' => 'voluptas',
                'status' => 1,
                'created_at' => ['sec' => 1470402895, 'usec' => 891000],
            ]),
        ];

        $response = new NewsResponse(1, [], 0);
        $this->assertEmpty($response->getItems());

        $response = new NewsResponse(2, $news, 0);
        $this->assertEquals($news, $response->getItems());
    }

    /**
     * @return void
     */
    public function testGetAllItems(): void
    {
        $response = new NewsResponse(1, [], 0);
        $this->assertEquals(0, $response->getAllItems());

        $response = new NewsResponse(2, [], 1);
        $this->assertEquals(1, $response->getAllItems());
    }

    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new NewsResponse(1, [], 0);
        $this->assertEquals(1, $response->getStatus());

        $response = new NewsResponse(2, [], 0);
        $this->assertEquals(2, $response->getStatus());
    }
}

