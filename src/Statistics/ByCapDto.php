<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ByCapDto
*/
class ByCapDto
{
    private int $offerId;

    /**
    * @var array<\Affise\Sdk\Statistics\StatDto>
    */
    private array $stats;

    public function __construct(array $attributes)
    {
        $this->offerId = $attributes['offer_id'];
        $this->stats = array_map(fn(array $item) => new StatDto($item), $attributes['stats'] ?? []);
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    /**
    * @return array<\Affise\Sdk\Statistics\StatDto>
    */
    public function getStats(): array
    {
        return $this->stats;
    }
}
