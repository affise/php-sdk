<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class TimeToActionDto
*/
class TimeToActionDto
{
    private int $affiliateId;
    private int $clicks;
    private int $totalConversions;
    private int $tta30;
    private int $tta600;
    private int $ttaInf;

    public function __construct(array $attributes)
    {
        $this->affiliateId = $attributes['affiliate_id'];
        $this->clicks = $attributes['clicks'];
        $this->totalConversions = $attributes['total_conversions'];
        $this->tta30 = $attributes['tta_30'];
        $this->tta600 = $attributes['tta_600'];
        $this->ttaInf = $attributes['tta_inf'];
    }

    public function getAffiliateId(): int
    {
        return $this->affiliateId;
    }

    public function getClicks(): int
    {
        return $this->clicks;
    }

    public function getTotalConversions(): int
    {
        return $this->totalConversions;
    }

    public function getTta30(): int
    {
        return $this->tta30;
    }

    public function getTta600(): int
    {
        return $this->tta600;
    }

    public function getTtaInf(): int
    {
        return $this->ttaInf;
    }
}
