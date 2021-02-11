<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\Offers\TargetingDto as OfferTargetingDto;

/**
* Class TargetingDto
*/
class TargetingDto extends OfferTargetingDto
{
    private string $url;
    private bool $blockProxy;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->url = $attributes['url'];
        $this->blockProxy = $attributes['block_proxy'];
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getBlockProxy(): bool
    {
        return $this->blockProxy;
    }
}
