<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
 * Class CurrencyListDto
 */
class CurrencyListDto
{
    private int $id;
    private string $code;
    private bool $active;
    private bool $default;
    private float $rate;
    private ?int $minPayment;
    private ?bool $isCrypto;

    /**
     * CurrencyListDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['_id'];
        $this->code = $attributes['code'];
        $this->active = $attributes['active'];
        $this->default = $attributes['default'];
        $this->rate = $attributes['rate'];
        $this->minPayment = $attributes['min_payment'] ?? null;
        $this->isCrypto = $attributes['is_crypto'] ?? null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getMinPayment(): ?int
    {
        return $this->minPayment;
    }

    public function getIsCrypto(): ?bool
    {
        return $this->isCrypto;
    }
}
