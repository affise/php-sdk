<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class BaseResponse
 */
class BaseResponse
{
    private int $status;

    /**
     * BaseResponse constructor.
     *
     * @param int $status
     */
    public function __construct(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
