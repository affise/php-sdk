<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class SmartLinkOfferCountDto
*/
class SmartLinkOfferCountDto
{
    private int $count;

    public function __construct(array $attributes)
    {
        $this->count = $attributes['count'];
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
