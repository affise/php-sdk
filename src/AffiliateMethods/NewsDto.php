<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

/**
* Class NewsDto
*/
class NewsDto
{
    private string $id;
    private string $title;
    private string $smallDesc;
    private string $desc;
    private int $status;

    /**
     * @var array<string, int>
     */
    private array $createdAt;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['_id']['$id'];
        $this->title = $attributes['title'];
        $this->smallDesc = $attributes['small_desc'];
        $this->desc = $attributes['desc'];
        $this->status = $attributes['status'];
        $this->createdAt = $attributes['created_at'] ?? [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSmallDesc(): string
    {
        return $this->smallDesc;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return array<string, int>
     */
    public function getCreatedAt(): array
    {
        return $this->createdAt;
    }
}
