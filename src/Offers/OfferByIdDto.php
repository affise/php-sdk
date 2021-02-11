<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class OfferByIdDto
*/
class OfferByIdDto extends OffersListDto
{
    private int $hideCaps;

    /**
     * @var array<mixed>
     */
    private array $subRestrictions;
    private ?string $redirectType;
    private string $capsTimezone;

    /**
     * @var array<mixed>
     */
    private array $strictlyDevices;
    private bool $disabledChoicePostbackStatus;

    /**
     * @var array<string>
     */
    private array $capsStatus;
    private ?string $searchEmptySub;

    /**
     * @var array<string, mixed>
     */
    private array $schedule;
    private string $clickSession;
    private ?string $minimalClickSession;
    private ?string $ioDocument;
    private bool $rejectNotUniqueIp;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->hideCaps = $attributes['hide_caps'];
        $this->subRestrictions = $attributes['sub_restrictions'] ?? [];
        $this->redirectType = $attributes['redirect_type'] ?? null;
        $this->capsTimezone = $attributes['caps_timezone'];
        $this->strictlyDevices = $attributes['strictly_devices'] ?? [];
        $this->disabledChoicePostbackStatus = $attributes['disabled_choice_postback_status'];
        $this->capsStatus = $attributes['caps_status'] ?? [];
        $this->searchEmptySub = $attributes['search_empty_sub'] ?? null;
        $this->schedule = $attributes['schedule'] ?? [];
        $this->clickSession = $attributes['click_session'];
        $this->minimalClickSession = $attributes['minimal_click_session'] ?? null;
        $this->ioDocument = $attributes['io_document'] ?? null;
        $this->rejectNotUniqueIp = $attributes['reject_not_unique_ip'];
    }

    public function getHideCaps(): int
    {
        return $this->hideCaps;
    }

    /**
     * @return array<mixed>
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
     * @return array<mixed>
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

    /**
     * @return array<string, mixed>
     */
    public function getSchedule(): array
    {
        return $this->schedule;
    }

    public function getClickSession(): string
    {
        return $this->clickSession;
    }

    public function getMinimalClickSession(): ?string
    {
        return $this->minimalClickSession;
    }

    public function getIoDocument(): ?string
    {
        return $this->ioDocument;
    }

    public function getRejectNotUniqueIp(): bool
    {
        return $this->rejectNotUniqueIp;
    }
}
