<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class Response
 *
 * @template T
 */
class Response extends BaseResponse
{
    /**
     * @var T
     */
    private $data;

    /**
     * Response constructor.
     *
     * @param int $status
     * @param T $data
     */
    public function __construct(int $status, $data)
    {
        parent::__construct($status);

        $this->data = $data;
    }

    /**
     * @return T
     */
    public function getData()
    {
        return $this->data;
    }
}
