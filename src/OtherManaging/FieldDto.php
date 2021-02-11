<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class FieldDto
*/
class FieldDto
{
    private int $id;
    private string $langLabel;
    private bool $required;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->langLabel = $attributes['lang_label'];
        $this->required = $attributes['required'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLangLabel(): string
    {
        return $this->langLabel;
    }

    public function getRequired(): bool
    {
        return $this->required;
    }
}
