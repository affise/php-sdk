<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class CustomFieldsListDto
*/
class CustomFieldsListDto
{
    private int $id;
    private string $name;
    private bool $required;
    private string $fieldType;

    /**
     * @var array<string>
     */
    private array $fieldValues;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->required = $attributes['required'];
        $this->fieldType = $attributes['field_type'];
        $this->fieldValues = $attributes['field_values'] ?? [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getFieldType(): string
    {
        return $this->fieldType;
    }

    public function getFieldValues(): array
    {
        return $this->fieldValues;
    }
}
