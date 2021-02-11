<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseResponseTest
 */
class BaseResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new BaseResponse(1);
        $this->assertEquals(1, $response->getStatus());

        $response = new BaseResponse(2);
        $this->assertEquals(2, $response->getStatus());
    }
}

