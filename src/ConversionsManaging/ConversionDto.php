<?php

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

/**
* Class ConversionDto
*/
class ConversionDto
{
    private int $offer;
    private int $pid;
    private ?string $actionId;
    private ?int $goal;
    private ?string $ip;
    private ?string $ua;
    private ?int $sum;
    private ?string $comment;

    public function __construct(array $attributes)
    {
        $this->offer = $attributes['offer'];
        $this->pid = $attributes['pid'];
        $this->actionId = $attributes['action_id'] ?? null;
        $this->goal = $attributes['goal'] ?? null;
        $this->ip = $attributes['ip'] ?? null;
        $this->ua = $attributes['ua'] ?? null;
        $this->sum = $attributes['sum'] ?? null;
        $this->comment = $attributes['comment'] ?? null;
    }

    public function getOffer(): int
    {
        return $this->offer;
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function getActionId(): ?string
    {
        return $this->actionId;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getUa(): ?string
    {
        return $this->ua;
    }

    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
