<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

/**
* Class CustomFieldsDto
*/
class CustomFieldsDto
{
    private string $name;

    /**
     * @var string|array<int>
     */
    private $value;

    /**
     * @var string|array<int, string>
     */
    private $label;
    private int $id;

    public function __construct(array $attributes)
    {
        $this->name = $attributes['name'];
        $this->value = $attributes['value'];
        $this->label = $attributes['label'];
        $this->id = $attributes['id'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|array<int>
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string|array<int, string>
     */
    public function getLabel()
    {
        return $this->label;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
