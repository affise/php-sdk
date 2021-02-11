<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class ResponseWithMessage
 *
 * @template T
 *
 * @extends Response<T>
 */
class ResponseWithMessage extends Response
{
    private string $message;

    /**
     * ResponseWithMessage constructor.
     *
     * @param int $status
     * @param T $data
     * @param string $message
     */
    public function __construct(int $status, $data, string $message)
    {
        parent::__construct($status, $data);

        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
