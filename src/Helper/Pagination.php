<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use InvalidArgumentException;

/**
 * Class Pagination
 */
class Pagination
{
    protected int $perPage;
    protected int $totalCount;
    protected int $page;
    private ?int $nextPage;

    /**
     * Pagination constructor.
     *
     * @param int $perPage
     * @param int $totalCount
     * @param int $page
     * @param int|null $nextPage
     */
    public function __construct(int $perPage, int $totalCount, int $page, ?int $nextPage = null)
    {
        $this->perPage = $perPage;
        $this->totalCount = $totalCount;
        $this->page = $page;
        $this->nextPage = $nextPage;
    }

    /**
     * @param array<string, int> $pagination
     * @psalm-param array{per_page: int, total_count: int, page: int, next_page?: int} $pagination
     *
     * @return \Affise\Sdk\Helper\Pagination
     */
    public static function createFromArray(array $pagination): Pagination
    {
        if (!isset($pagination['per_page'])) {
            throw new InvalidArgumentException("Key 'per_page' cannot be empty");
        }

        if (!isset($pagination['total_count'])) {
            throw new InvalidArgumentException("Key 'total_count' cannot be empty");
        }

        if (!isset($pagination['page'])) {
            throw new InvalidArgumentException("Key 'page' cannot be empty");
        }

        return new self($pagination['per_page'], $pagination['total_count'], $pagination['page'], $pagination['next_page'] ?? null);
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getNextPage(): ?int
    {
        return $this->nextPage;
    }
}
