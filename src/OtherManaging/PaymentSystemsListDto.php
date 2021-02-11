<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class PaymentSystemsListDto
*/
class PaymentSystemsListDto
{
    private int $id;
    private string $langLabel;

    /**
    * @var array<\Affise\Sdk\OtherManaging\FieldDto>
    */
    private array $fields;
    private ?string $currency;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->langLabel = $attributes['lang_label'];
        $this->fields = array_map(fn(array $item) => new FieldDto($item), $attributes['fields'] ?? []);
        $this->currency = $attributes['currency'] ?? null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLangLabel(): string
    {
        return $this->langLabel;
    }

    /**
    * @return array<\Affise\Sdk\OtherManaging\FieldDto>
    */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }
}
