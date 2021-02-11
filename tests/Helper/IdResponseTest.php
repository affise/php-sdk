<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class IdResponseTest
 */
class IdResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new IdResponse(1, [], 1);
        $this->assertEquals(1, $response->getStatus());

        $response = new IdResponse(2, [], 2);
        $this->assertEquals(2, $response->getStatus());
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $response = new IdResponse(1, [], 1);
        $this->assertEquals([], $response->getData());

        $response = new IdResponse(1, 'test', 1);
        $this->assertEquals('test', $response->getData());

        $response = new IdResponse(1, [['a' => 15, 'b' => 25], ['a', 'b', 'c']], 1);
        $this->assertEquals([['a' => 15, 'b' => 25], ['a', 'b', 'c']], $response->getData());
    }

    /**
     * @return void
     */
    public function testGetId(): void
    {
        $response = new IdResponse(1, [], 1);
        $this->assertEquals(1, $response->getId());

        $response = new IdResponse(2, [], 2);
        $this->assertEquals(2, $response->getId());
    }
}

