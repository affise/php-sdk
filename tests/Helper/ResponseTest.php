<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 */
class ResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new Response(1, []);
        $this->assertEquals(1, $response->getStatus());

        $response = new Response(2, []);
        $this->assertEquals(2, $response->getStatus());
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $response = new Response(1, []);
        $this->assertEquals([], $response->getData());

        $response = new Response(1, 'test');
        $this->assertEquals('test', $response->getData());

        $response = new Response(1, [['a' => 15, 'b' => 25], ['a', 'b', 'c']]);
        $this->assertEquals([['a' => 15, 'b' => 25], ['a', 'b', 'c']], $response->getData());
    }
}

