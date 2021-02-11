<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

/**
* Class SourceEditDto
*/
class SourceEditDto
{
    private string $title;

    /**
    * @var array<string, string>
    */
    private array $titleLang;
    private string $id;

    public function __construct(array $attributes)
    {
        $this->title = $attributes['title'];
        $this->titleLang = $attributes['title_lang'] ?? [];
        $this->id = $attributes['id'];
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

    public function getId(): string
    {
        return $this->id;
    }
}
