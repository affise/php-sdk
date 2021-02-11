<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class RemovableResponse
 */
class RemovableResponse extends BaseResponse
{
    /**
     * @var array<int>
     */
    private array $removed;

    /**
     * RemovableResponse constructor.
     *
     * @param int $status
     * @param array<int> $removed
     */
    public function __construct(int $status, array $removed)
    {
        parent::__construct($status);

        $this->removed = $removed;
    }

    /**
     * @return array<int>
     */
    public function getRemoved(): array
    {
        return $this->removed;
    }
}
