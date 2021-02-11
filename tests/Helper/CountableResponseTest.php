<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class CountableResponseTest
 */
class CountableResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetCount(): void
    {
        $response = new CountableResponse(1, 1);
        $this->assertEquals(1, $response->getCount());

        $response = new CountableResponse(1, 2);
        $this->assertEquals(2, $response->getCount());
    }

    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new CountableResponse(1, 1);
        $this->assertEquals(1, $response->getStatus());

        $response = new CountableResponse(2, 1);
        $this->assertEquals(2, $response->getStatus());
    }
}

