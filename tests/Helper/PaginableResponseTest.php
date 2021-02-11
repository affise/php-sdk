<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Class PaginableResponseTest
 */
class PaginableResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetPagination(): void
    {
        $response = new PaginableResponse(1, [], new Pagination(10, 100, 1));

        $this->assertEquals(new Pagination(10, 100, 1), $response->getPagination());
    }

    /**
     * @return void
     */
    public function testGetStatus(): void
    {
        $response = new PaginableResponse(1, [], new Pagination(10, 100, 1));
        $this->assertEquals(1, $response->getStatus());

        $response = new PaginableResponse(2, [], new Pagination(10, 100, 1));
        $this->assertEquals(2, $response->getStatus());
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $response = new PaginableResponse(1, [], new Pagination(10, 100, 1));
        $this->assertEquals([], $response->getData());

        $response = new PaginableResponse(1, ['test'], new Pagination(10, 100, 1));
        $this->assertEquals(['test'], $response->getData());

        $response = new PaginableResponse(1, [['a' => 15, 'b' => 25], ['a', 'b', 'c']], new Pagination(10, 100, 1));
        $this->assertEquals([['a' => 15, 'b' => 25], ['a', 'b', 'c']], $response->getData());
    }
}

