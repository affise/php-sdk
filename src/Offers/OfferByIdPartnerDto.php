<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
 * Class OfferByIdPartnerDto
 */
class OfferByIdPartnerDto extends OffersListPartnerDto
{
    /**
     * @var array<mixed>
     */
    private array $subRestrictions;
    private ?string $redirectType;
    private string $capsTimezone;

    /**
     * @var array<string>
     */
    private array $strictlyDevices;
    private bool $disabledChoicePostbackStatus;

    /**
     * @var array<string>
     */
    private array $capsStatus;
    private ?string $searchEmptySub;
    private ?string $ioDocument;

    /**
     * @var array<string, string>
     */
    private array $goals;

    /**
     * @var array<mixed>
     */
    private array $postbacks;

    /**
     * @var array<mixed>
     */
    private array $pixels;
    private bool $ticketCreated;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->subRestrictions = $attributes['sub_restrictions'] ?? [];
        $this->redirectType = $attributes['redirect_type'] ?? null;
        $this->capsTimezone = $attributes['caps_timezone'];
        $this->strictlyDevices = $attributes['strictly_devices'] ?? [];
        $this->disabledChoicePostbackStatus = $attributes['disabled_choice_postback_status'];
        $this->capsStatus = $attributes['caps_status'] ?? [];
        $this->searchEmptySub = $attributes['search_empty_sub'] ?? null;
        $this->ioDocument = $attributes['io_document'] ?? null;
        $this->goals = $attributes['goals'] ?? [];
        $this->postbacks = $attributes['postbacks'] ?? [];
        $this->pixels = $attributes['pixels'] ?? [];
        $this->ticketCreated = $attributes['ticket_created'];
    }

    /**
     * @return array<string>
     */
    public function getSubRestrictions(): array
    {
        return $this->subRestrictions;
    }

    public function getRedirectType(): ?string
    {
        return $this->redirectType;
    }

    public function getCapsTimezone(): string
    {
        return $this->capsTimezone;
    }

    /**
     * @return array<string>
     */
    public function getStrictlyDevices(): array
    {
        return $this->strictlyDevices;
    }

    public function getDisabledChoicePostbackStatus(): bool
    {
        return $this->disabledChoicePostbackStatus;
    }

    /**
     * @return array<string>
     */
    public function getCapsStatus(): array
    {
        return $this->capsStatus;
    }

    public function getSearchEmptySub(): ?string
    {
        return $this->searchEmptySub;
    }

    public function getIoDocument(): ?string
    {
        return $this->ioDocument;
    }

    /**
     * @return array<string, string>
     */
    public function getGoals(): array
    {
        return $this->goals;
    }

    /**
     * @return array<mixed>
     */
    public function getPostbacks(): array
    {
        return $this->postbacks;
    }

    /**
     * @return array<mixed>
     */
    public function getPixels(): array
    {
        return $this->pixels;
    }

    public function isTicketCreated(): bool
    {
        return $this->ticketCreated;
    }
}
