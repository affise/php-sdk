<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

/**
* Class AffiliateBalanceDto
*/
class AffiliateBalanceDto
{
    /**
    * @var array<string, int>
    */
    private array $balance;

    /**
    * @var array<string, int>
    */
    private array $hold;

    /**
    * @var array<string, int>
    */
    private array $available;

    public function __construct(array $attributes)
    {
        $this->balance = $attributes['balance'] ?? [];
        $this->hold = $attributes['hold'] ?? [];
        $this->available = $attributes['available'] ?? [];
    }

    /**
    * @return array<string, int>
    */
    public function getBalance(): array
    {
        return $this->balance;
    }

    /**
    * @return array<string, int>
    */
    public function getHold(): array
    {
        return $this->hold;
    }

    /**
    * @return array<string, int>
    */
    public function getAvailable(): array
    {
        return $this->available;
    }
}
