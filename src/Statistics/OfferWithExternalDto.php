<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
 * Class WithExternalOfferDto
 */
class OfferWithExternalDto extends OfferDto
{
    private ?string $externalOfferId;

    /**
     * WithExternalOfferDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->externalOfferId = $attributes['external_offer_id'] ?? null;
    }

    public function getExternalOfferId(): ?string
    {
        return $this->externalOfferId;
    }
}
