<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

/**
* Class PaymentSystemsDto
*/
class PaymentSystemsDto
{
    private int $id;
    private int $active;
    private string $system;
    private int $currency;
    private int $systemId;

    /**
    * @var array<string>
    */
    private array $fields;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->active = $attributes['active'];
        $this->system = $attributes['system'];
        $this->fields = $attributes['fields'] ?? [];
        $this->currency = $attributes['currency'];
        $this->systemId = $attributes['system_id'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function getSystem(): string
    {
        return $this->system;
    }

    /**
    * @return array<string>
    */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }

    public function getSystemId(): int
    {
        return $this->systemId;
    }
}
