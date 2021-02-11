<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ByReferralPaymentsDto
*/
class ByReferralPaymentsDto
{
    /**
    * @var array<string, string>
    */
    private array $total;

    public function __construct(array $attributes)
    {
        $this->total = $attributes['total'] ?? [];
    }

    /**
    * @return array<string, string>
    */
    public function getTotal(): array
    {
        return $this->total;
    }
}
