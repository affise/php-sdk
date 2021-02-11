<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class MessageResponse
 *
 * @template T
 */
class MessageResponse extends BaseResponse
{
    /**
     * @var T
     */
    private $message;

    /**
     * MessageResponse constructor.
     *
     * @param int $status
     * @param T $message
     */
    public function __construct(int $status, $message)
    {
        parent::__construct($status);

        $this->message = $message;
    }

    /**
     * @return T
     */
    public function getMessage()
    {
        return $this->message;
    }
}
