<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class PaginationTest
 */
class PaginationTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateFromArray(): void
    {
        $pagination = Pagination::createFromArray([
            'per_page' => 10,
            'total_count' => 100,
            'page' => 1,
        ]);

        $this->assertEquals(10, $pagination->getPerPage());
        $this->assertEquals(100, $pagination->getTotalCount());
        $this->assertEquals(1, $pagination->getPage());
        $this->assertNull($pagination->getNextPage());

        $pagination = Pagination::createFromArray([
            'per_page' => 10,
            'total_count' => 100,
            'page' => 1,
            'next_page' => 2,
        ]);

        $this->assertEquals(10, $pagination->getPerPage());
        $this->assertEquals(100, $pagination->getTotalCount());
        $this->assertEquals(1, $pagination->getPage());
        $this->assertEquals(2, $pagination->getNextPage());
    }

    /**
     * @return void
     *
     * @psalm-suppress InvalidArgument
     */
    public function testCreateFromArrayWithEmptyArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Pagination::createFromArray([]);
    }

    /**
     * @return void
     */
    public function testCreateFromArrayWithZeroValues(): void
    {
        $pagination = Pagination::createFromArray([
            'per_page' => 0,
            'total_count' => 0,
            'page' => 0,
            'next_page' => 0,
        ]);

        $this->assertEquals(0, $pagination->getPerPage());
        $this->assertEquals(0, $pagination->getTotalCount());
        $this->assertEquals(0, $pagination->getPage());
        $this->assertEquals(0, $pagination->getNextPage());
    }

    /**
     * @return void
     *
     * @psalm-suppress InvalidArgument
     */
    public function testCreateFromArrayWithoutPerPageKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Key 'per_page' cannot be empty");

        Pagination::createFromArray(['total_count' => 100, 'page' => 1]);
    }

    /**
     * @return void
     *
     * @psalm-suppress InvalidArgument
     */
    public function testCreateFromArrayWithoutTotalCountKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Key 'total_count' cannot be empty");

        Pagination::createFromArray(['per_page' => 10, 'page' => 1]);
    }

    /**
     * @return void
     *
     * @psalm-suppress InvalidArgument
     */
    public function testCreateFromArrayWithoutPageKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Key 'page' cannot be empty");

        Pagination::createFromArray(['total_count' => 100, 'per_page' => 10]);
    }

    /**
     * @return void
     */
    public function testGetTotalCount(): void
    {
        $pagination = new Pagination(10, 100, 1);

        $this->assertEquals(100, $pagination->getTotalCount());
    }

    /**
     * @return void
     */
    public function testGetPerPage(): void
    {
        $pagination = new Pagination(10, 100, 1);

        $this->assertEquals(10, $pagination->getPerPage());
    }

    /**
     * @return void
     */
    public function testGetPage(): void
    {
        $pagination = new Pagination(10, 100, 1);

        $this->assertEquals(1, $pagination->getPage());
    }

    /**
     * @return void
     */
    public function testGetNextPage(): void
    {
        $pagination = new Pagination(10, 100, 1);
        $this->assertNull($pagination->getNextPage());

        $pagination = new Pagination(10, 100, 1, 2);
        $this->assertEquals(2, $pagination->getNextPage());
    }
}
