<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
 * Class FullCategoryDto
 */
class FullCategoryDto
{
    private string $id;
    private string $title;

    /**
     * FullCategoryDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
