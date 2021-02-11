<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class IdResponse
 *
 * @template T
 * @template I
 *
 * @extends Response<T>
 */
class IdResponse extends Response
{
    /**
     * @var I
     */
    private $id;

    /**
     * IdResponse constructor.
     *
     * @param int $status
     * @param T $data
     * @param I $id
     */
    public function __construct(int $status, $data, $id)
    {
        parent::__construct($status, $data);

        $this->id = $id;
    }

    /**
     * @return I
     */
    public function getId()
    {
        return $this->id;
    }
}
