<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class RemovableResponseTest
 */
class RemovableResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetRemoved(): void
    {
        $response = new RemovableResponse(1, []);
        $this->assertEmpty($response->getRemoved());

        $response = new RemovableResponse(1, [1, 2]);
        $this->assertEquals([1, 2], $response->getRemoved());

        $response = new RemovableResponse(2, [1, 2, 3]);
        $this->assertEquals([1, 2, 3], $response->getRemoved());
    }

    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new RemovableResponse(1, []);
        $this->assertEquals(1, $response->getStatus());

        $response = new RemovableResponse(2, []);
        $this->assertEquals(2, $response->getStatus());
    }
}

