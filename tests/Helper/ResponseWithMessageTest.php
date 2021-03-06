<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class ResponseWithMessageTest
 */
class ResponseWithMessageTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new ResponseWithMessage(1, [], '');
        $this->assertEquals(1, $response->getStatus());

        $response = new ResponseWithMessage(2, [], '');
        $this->assertEquals(2, $response->getStatus());
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $response = new ResponseWithMessage(1, [], '');
        $this->assertEquals([], $response->getData());

        $response = new ResponseWithMessage(1, 'test', '');
        $this->assertEquals('test', $response->getData());

        $response = new ResponseWithMessage(1, [['a' => 15, 'b' => 25], ['a', 'b', 'c']], '');
        $this->assertEquals([['a' => 15, 'b' => 25], ['a', 'b', 'c']], $response->getData());
    }

    /**
     * @return void
     */
    public function testGetMessage(): void
    {
        $response = new ResponseWithMessage(1, [], '');
        $this->assertEmpty($response->getMessage());

        $response = new ResponseWithMessage(1, [], 'test');
        $this->assertEquals('test', $response->getMessage());
    }
}

