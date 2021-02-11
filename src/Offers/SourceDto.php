<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class SourceDto
*/
class SourceDto
{
    private string $id;
    private string $title;
    private int $allowed;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->allowed = $attributes['allowed'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAllowed(): int
    {
        return $this->allowed;
    }
}
