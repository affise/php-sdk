<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ByTrafficbackDto
*/
class ByTrafficbackDto
{

    /**
    * @var array<string, string>
    */
    private array $slice;

    /**
    * @var array<string, string>
    */
    private array $traffic;

    /**
    * @var array<mixed>
    */
    private array $actions;
    private int $views;
    private int $ctr;
    private int $ecpm;
    private int $trafficback;

    public function __construct(array $attributes)
    {
        $this->slice = $attributes['slice'] ?? [];
        $this->traffic = $attributes['traffic'] ?? [];
        $this->actions = $attributes['actions'] ?? [];
        $this->views = $attributes['views'];
        $this->ctr = $attributes['ctr'];
        $this->ecpm = $attributes['ecpm'];
        $this->trafficback = $attributes['trafficback'];
    }

    /**
    * @return array<string, string>
    */
    public function getSlice(): array
    {
        return $this->slice;
    }

    /**
    * @return array<string, string>
    */
    public function getTraffic(): array
    {
        return $this->traffic;
    }

    /**
    * @return array<mixed>
    */
    public function getActions(): array
    {
        return $this->actions;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getCtr(): int
    {
        return $this->ctr;
    }

    public function getEcpm(): int
    {
        return $this->ecpm;
    }

    public function getTrafficback(): int
    {
        return $this->trafficback;
    }
}
