<?php

declare(strict_types=1);

namespace Affise\Sdk\AdvertiserBilling;

/**
* Class InvoiceDto
*/
class InvoiceDto
{
    private int $number;
    private string $supplierId;
    private string $createdAt;
    private string $updatedAt;
    private string $startDate;
    private string $endDate;
    private string $status;

    /**
    * @var array<\Affise\Sdk\AdvertiserBilling\DetailDto>
    */
    private array $detail;
    private string $currency;
    private ?string $comment;

    public function __construct(array $attributes)
    {
        $this->number = $attributes['number'];
        $this->supplierId = $attributes['supplier_id'];
        $this->createdAt = $attributes['created_at'];
        $this->updatedAt = $attributes['updated_at'];
        $this->startDate = $attributes['start_date'];
        $this->endDate = $attributes['end_date'];
        $this->status = $attributes['status'];
        $this->detail = array_map(fn(array $item) => new DetailDto($item), $attributes['detail'] ?? []);
        $this->currency = $attributes['currency'];
        $this->comment = $attributes['comment'] ?? null;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getSupplierId(): string
    {
        return $this->supplierId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
    * @return array<\Affise\Sdk\AdvertiserBilling\DetailDto>
    */
    public function getDetail(): array
    {
        return $this->detail;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
