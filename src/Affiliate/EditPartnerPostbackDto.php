<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

/**
* Class EditPartnerPostbackDto
*/
class EditPartnerPostbackDto
{
    private int $id;
    private string $url;
    private string $status;
    private ?string $goal;
    private string $created;
    private string $updatedAt;
    private string $forced;
    private string $pid;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->url = $attributes['url'];
        $this->status = $attributes['status'];
        $this->goal = $attributes['goal'] ?? null;
        $this->created = $attributes['created'];
        $this->updatedAt = $attributes['updated_at'];
        $this->forced = $attributes['forced'];
        $this->pid = $attributes['pid'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getForced(): string
    {
        return $this->forced;
    }

    public function getPid(): string
    {
        return $this->pid;
    }
}
