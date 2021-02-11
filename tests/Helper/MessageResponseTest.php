<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class MessageResponseTest
 */
class MessageResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new MessageResponse(1, 'test');
        $this->assertEquals(1, $response->getStatus());

        $response = new MessageResponse(2, 'test');
        $this->assertEquals(2, $response->getStatus());
    }

    /**
     * @return void
     */
    public function testGetMessage(): void
    {
        $response = new MessageResponse(1, 'test');
        $this->assertEquals('test', $response->getMessage());

        $response = new MessageResponse(2, 'other');
        $this->assertEquals('other', $response->getMessage());

        $response = new MessageResponse(2, []);
        $this->assertEquals([], $response->getMessage());

        $response = new MessageResponse(2, ['test']);
        $this->assertEquals(['test'], $response->getMessage());
    }
}

