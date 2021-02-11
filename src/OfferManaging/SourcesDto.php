<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

/**
* Class SourcesDto
*/
class SourcesDto
{
    private string $id;
    private string $title;

    /**
    * @var array<string, string>
    */
    private array $titleLang;
    private int $allowed;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->titleLang = $attributes['title_lang'] ?? [];
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

    /**
    * @return array<string, string>
    */
    public function getTitleLang(): array
    {
        return $this->titleLang;
    }

    public function getAllowed(): int
    {
        return $this->allowed;
    }
}
