<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
 * Class StatisticDto
 */
class StatisticDto
{
    /**
     * @var array<string, mixed>
     */
    protected array $slice;

    /**
     * @var array<string, string>
     */
    private array $traffic;

    /**
     * @var array<string, array<string, int|float>>
     */
    private array $actions;
    private int $views;
    private float $ctr;
    private float $ecpm;

    /**
     * @var array<string, int>
     */
    private array $cr;
    private string $ratio;
    private float $epc;
    private ?int $trafficback;

    /**
     * StatisticDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->slice = $attributes['slice'];
        $this->traffic = $attributes['traffic'] ?? [];
        $this->actions = $attributes['actions'] ?? [];
        $this->views = $attributes['views'];
        $this->ctr = $attributes['ctr'];
        $this->ecpm = $attributes['ecpm'];
        $this->cr = $attributes['cr'] ?? [];
        $this->ratio = $attributes['ratio'];
        $this->epc = $attributes['epc'];
        $this->trafficback = $attributes['trafficback'] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSlice(): array
    {
        return $this->slice;
    }

    /**
     * @return array<string>
     */
    public function getTraffic(): array
    {
        return $this->traffic;
    }

    /**
     * @return array<string, array<string, int|float>>
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getCtr(): float
    {
        return $this->ctr;
    }

    public function getEcpm(): float
    {
        return $this->ecpm;
    }

    /**
     * @return array<int>
     */
    public function getCr(): array
    {
        return $this->cr;
    }

    public function getRatio(): string
    {
        return $this->ratio;
    }

    public function getEpc(): float
    {
        return $this->epc;
    }

    public function getTrafficback(): ?int
    {
        return $this->trafficback;
    }
}
