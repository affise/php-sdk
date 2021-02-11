<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class RetentionRateDto
*/
class RetentionRateDto
{
    private int $affiliateId;
    private string $date;
    private float $rrInstall;
    private int $rrOther1;
    private float $rrOther2;
    private int $installCount;

    public function __construct(array $attributes)
    {
        $this->affiliateId = $attributes['affiliate_id'];
        $this->date = $attributes['date'];
        $this->rrInstall = $attributes['rr_install'];
        $this->rrOther1 = $attributes['rr_other1'];
        $this->rrOther2 = $attributes['rr_other2'];
        $this->installCount = $attributes['install_count'];
    }

    public function getAffiliateId(): int
    {
        return $this->affiliateId;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getRrInstall(): float
    {
        return $this->rrInstall;
    }

    public function getRrOther1(): int
    {
        return $this->rrOther1;
    }

    public function getRrOther2(): float
    {
        return $this->rrOther2;
    }

    public function getInstallCount(): int
    {
        return $this->installCount;
    }
}
