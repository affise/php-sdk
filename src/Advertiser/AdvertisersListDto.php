<?php

declare(strict_types=1);

namespace Affise\Sdk\Advertiser;

/**
* Class AdvertisersListDto
*/
class AdvertisersListDto extends AdvertiserDto
{
    private int $offers;
    private bool $hasUser;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->offers = $attributes['offers'];
        $this->hasUser = $attributes['has_user'];
    }

    public function getOffers(): int
    {
        return $this->offers;
    }

    public function getHasUser(): bool
    {
        return $this->hasUser;
    }
}
