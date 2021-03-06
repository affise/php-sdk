<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class CategoriesDto
*/
class CategoriesDto
{
    private string $id;
    private string $title;

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
