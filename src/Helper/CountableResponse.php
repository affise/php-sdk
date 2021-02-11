<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class CountableResponse
 */
class CountableResponse extends BaseResponse
{
    private int $count;

    /**
     * CountableResponse constructor.
     *
     * @param int $status
     * @param int $count
     */
    public function __construct(int $status, int $count)
    {
        parent::__construct($status);

        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
