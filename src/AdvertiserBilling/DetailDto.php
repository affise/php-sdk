<?php

declare(strict_types=1);

namespace Affise\Sdk\AdvertiserBilling;

/**
* Class DetailDto
*/
class DetailDto
{
    private int $offerId;
    private string $payoutType;
    private int $actions;
    private int $amount;
    private ?string $comment;

    public function __construct(array $attributes)
    {
        $this->offerId = $attributes['offer_id'];
        $this->payoutType = $attributes['payout_type'];
        $this->actions = $attributes['actions'];
        $this->amount = $attributes['amount'];
        $this->comment = $attributes['comment'] ?? null;
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getPayoutType(): string
    {
        return $this->payoutType;
    }

    public function getActions(): int
    {
        return $this->actions;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
