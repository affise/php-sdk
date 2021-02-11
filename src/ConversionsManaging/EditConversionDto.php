<?php

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

/**
 * Class EditConversionDto
 */
class EditConversionDto
{
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_PENDING = 'pending';
    public const STATUS_DECLINED = 'declined';
    public const STATUS_NOT_FOUND = 'not_found';
    public const STATUS_HOLD = 'hold';

    /**
     * @var array<string>
     */
    private array $ids;
    private string $status;
    private ?string $currency;
    private ?int $payouts;
    private ?int $revenue;

    /**
     * EditConversionDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->ids = $attributes['ids'];
        $this->status = $attributes['status'];
        $this->currency = $attributes['currency'] ?? null;
        $this->payouts = $attributes['payouts'] ?? null;
        $this->revenue = $attributes['revenue'] ?? null;
    }

    /**
     * @return array<string>
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getPayouts(): ?int
    {
        return $this->payouts;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }
}
