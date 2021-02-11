<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class PaginableResponse
 *
 * @template T
 *
 * @extends Response<array<T>>
 */
class PaginableResponse extends Response
{
    private Pagination $pagination;

    /**
     * PaginableResponse constructor.
     *
     * @param int $status
     * @param array<T> $data
     * @param \Affise\Sdk\Helper\Pagination $pagination
     */
    public function __construct(int $status, array $data, Pagination $pagination)
    {
        parent::__construct($status, $data);

        $this->pagination = $pagination;
    }

    /**
     * @return \Affise\Sdk\Helper\Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
