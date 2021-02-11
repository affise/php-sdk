<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

/**
 * Class NewsResponse
 */
class NewsResponse extends BaseResponse
{
    /**
     * @var array<string, \Affise\Sdk\AffiliateMethods\NewsDto>
     */
    private array $items;
    private int $allItems;

    /**
     * NewsResponse constructor.
     *
     * @param int $status
     * @param array<string, \Affise\Sdk\AffiliateMethods\NewsDto> $items
     * @param int $allItems
     */
    public function __construct(int $status, array $items, int $allItems)
    {
        parent::__construct($status);

        $this->items = $items;
        $this->allItems = $allItems;
    }

    /**
     * @return array<string, \Affise\Sdk\AffiliateMethods\NewsDto>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getAllItems(): int
    {
        return $this->allItems;
    }
}
