<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\Offers\SourceDto;

/**
* Class OfferDto
*/
class OfferDto
{
    private int $id;
    private string $offerId;
    private string $title;
    private string $previewUrl;
    private string $crossPostbackUrl;

    /**
    * @var array<string, string>
    */
    private array $descriptionLang;
    private int $cr;
    private int $epc;
    private bool $sendEmails;
    private string $logo;
    private string $logoSource;
    private ?string $stopAt;

    /**
    * @var array<\Affise\Sdk\Offers\SourceDto>
    */
    private array $sources;

    /**
    * @var array<mixed>
    */
    private array $categories;

    /**
    * @var array<mixed>
    */
    private array $fullCategories;

    /**
    * @var array<\Affise\Sdk\OtherManaging\PaymentDto>
    */
    private array $payments;

    /**
    * @var array<string>
    */
    private array $goals;

    /**
    * @var array<mixed>
    */
    private array $caps;
    private string $capsTimezone;
    private int $hideCaps;
    private bool $requiredApproval;
    private ?string $strictlyCountry;
    private ?string $strictlyOs;
    private ?string $strictlyBrands;
    private bool $isCpi;

    /**
    * @var array<string, string>
    */
    private array $kpi;

    /**
    * @var array<mixed>
    */
    private array $creatives;
    private ?string $creativesZip;

    /**
    * @var array<mixed>
    */
    private array $landings;

    /**
    * @var array<mixed>
    */
    private array $links;
    private string $macroUrl;
    private ?string $link;
    private bool $useHttps;
    private bool $useHttp;
    private int $holdPeriod;
    private string $clickSession;
    private string $minimalClickSession;
    private bool $disabledChoicePostbackStatus;

    /**
    * @var array<mixed>
    */
    private array $strictlyIsp;
    private ?string $restrictionIsp;
    private ?string $searchEmptySub;

    /**
    * @var array<\Affise\Sdk\OtherManaging\TargetingDto>
    */
    private array $targeting;

    /**
    * @var array<string, mixed>
    */
    private array $schedule;
    private ?string $ioDocument;
    private bool $considerPersonalTargetingOnly;
    private bool $hostsOnly;
    private ?string $impressionsLink;
    private bool $uniqIpOnly;
    private bool $rejectNotUniqueIp;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->offerId = $attributes['offer_id'];
        $this->title = $attributes['title'];
        $this->previewUrl = $attributes['preview_url'];
        $this->crossPostbackUrl = $attributes['cross_postback_url'];
        $this->descriptionLang = $attributes['description_lang'] ?? [];
        $this->cr = $attributes['cr'];
        $this->epc = $attributes['epc'];
        $this->sendEmails = $attributes['send_emails'];
        $this->logo = $attributes['logo'];
        $this->logoSource = $attributes['logo_source'];
        $this->stopAt = $attributes['stop_at'] ?? null;
        $this->sources = array_map(fn(array $item) => new SourceDto($item), $attributes['sources'] ?? []);
        $this->categories = $attributes['categories'] ?? [];
        $this->fullCategories = $attributes['full_categories'] ?? [];
        $this->payments = array_map(fn(array $item) => new PaymentDto($item), $attributes['payments'] ?? []);
        $this->goals = $attributes['goals'] ?? [];
        $this->caps = $attributes['caps'] ?? [];
        $this->capsTimezone = $attributes['caps_timezone'];
        $this->hideCaps = $attributes['hide_caps'];
        $this->requiredApproval = $attributes['required_approval'];
        $this->strictlyCountry = $attributes['strictly_country'] ?? null;
        $this->strictlyOs = $attributes['strictly_os'] ?? null;
        $this->strictlyBrands = $attributes['strictly_brands'] ?? null;
        $this->isCpi = $attributes['is_cpi'];
        $this->kpi = $attributes['kpi'] ?? [];
        $this->creatives = $attributes['creatives'] ?? [];
        $this->creativesZip = $attributes['creatives_zip'] ?? null;
        $this->landings = $attributes['landings'] ?? [];
        $this->links = $attributes['links'] ?? [];
        $this->macroUrl = $attributes['macro_url'];
        $this->link = $attributes['link'] ?? null;
        $this->useHttps = $attributes['use_https'];
        $this->useHttp = $attributes['use_http'];
        $this->holdPeriod = $attributes['hold_period'];
        $this->clickSession = $attributes['click_session'];
        $this->minimalClickSession = $attributes['minimal_click_session'];
        $this->disabledChoicePostbackStatus = $attributes['disabled_choice_postback_status'];
        $this->strictlyIsp = $attributes['strictly_isp'] ?? [];
        $this->restrictionIsp = $attributes['restriction_isp'] ?? null;
        $this->searchEmptySub = $attributes['search_empty_sub'] ?? null;
        $this->targeting = array_map(fn(array $item) => new TargetingDto($item), $attributes['targeting'] ?? []);
        $this->schedule = $attributes['schedule'] ?? [];
        $this->ioDocument = $attributes['io_document'] ?? null;
        $this->considerPersonalTargetingOnly = $attributes['consider_personal_targeting_only'];
        $this->hostsOnly = $attributes['hosts_only'];
        $this->impressionsLink = $attributes['impressions_link'] ?? null;
        $this->uniqIpOnly = $attributes['uniq_ip_only'];
        $this->rejectNotUniqueIp = $attributes['reject_not_unique_ip'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOfferId(): string
    {
        return $this->offerId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPreviewUrl(): string
    {
        return $this->previewUrl;
    }

    public function getCrossPostbackUrl(): string
    {
        return $this->crossPostbackUrl;
    }

    /**
    * @return array<string, string>
    */
    public function getDescriptionLang(): array
    {
        return $this->descriptionLang;
    }

    public function getCr(): int
    {
        return $this->cr;
    }

    public function getEpc(): int
    {
        return $this->epc;
    }

    public function getSendEmails(): bool
    {
        return $this->sendEmails;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getLogoSource(): string
    {
        return $this->logoSource;
    }

    public function getStopAt(): ?string
    {
        return $this->stopAt;
    }

    /**
    * @return array<\Affise\Sdk\Offers\SourceDto>
    */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
    * @return array<mixed>
    */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
    * @return array<mixed>
    */
    public function getFullCategories(): array
    {
        return $this->fullCategories;
    }

    /**
    * @return array<\Affise\Sdk\OtherManaging\PaymentDto>
    */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
    * @return array<string>
    */
    public function getGoals(): array
    {
        return $this->goals;
    }

    /**
    * @return array<mixed>
    */
    public function getCaps(): array
    {
        return $this->caps;
    }

    public function getCapsTimezone(): string
    {
        return $this->capsTimezone;
    }

    public function getHideCaps(): int
    {
        return $this->hideCaps;
    }

    public function getRequiredApproval(): bool
    {
        return $this->requiredApproval;
    }

    public function getStrictlyCountry(): ?string
    {
        return $this->strictlyCountry;
    }

    public function getStrictlyOs(): ?string
    {
        return $this->strictlyOs;
    }

    public function getStrictlyBrands(): ?string
    {
        return $this->strictlyBrands;
    }

    public function getIsCpi(): bool
    {
        return $this->isCpi;
    }

    /**
    * @return array<string, string>
    */
    public function getKpi(): array
    {
        return $this->kpi;
    }

    /**
    * @return array<mixed>
    */
    public function getCreatives(): array
    {
        return $this->creatives;
    }

    public function getCreativesZip(): ?string
    {
        return $this->creativesZip;
    }

    /**
    * @return array<mixed>
    */
    public function getLandings(): array
    {
        return $this->landings;
    }

    /**
    * @return array<mixed>
    */
    public function getLinks(): array
    {
        return $this->links;
    }

    public function getMacroUrl(): string
    {
        return $this->macroUrl;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getUseHttps(): bool
    {
        return $this->useHttps;
    }

    public function getUseHttp(): bool
    {
        return $this->useHttp;
    }

    public function getHoldPeriod(): int
    {
        return $this->holdPeriod;
    }

    public function getClickSession(): string
    {
        return $this->clickSession;
    }

    public function getMinimalClickSession(): string
    {
        return $this->minimalClickSession;
    }

    public function getDisabledChoicePostbackStatus(): bool
    {
        return $this->disabledChoicePostbackStatus;
    }

    /**
    * @return array<mixed>
    */
    public function getStrictlyIsp(): array
    {
        return $this->strictlyIsp;
    }

    public function getRestrictionIsp(): ?string
    {
        return $this->restrictionIsp;
    }

    public function getSearchEmptySub(): ?string
    {
        return $this->searchEmptySub;
    }

    /**
    * @return array<\Affise\Sdk\OtherManaging\TargetingDto>
    */
    public function getTargeting(): array
    {
        return $this->targeting;
    }

    /**
    * @return array<string, mixed>
    */
    public function getSchedule(): array
    {
        return $this->schedule;
    }

    public function getIoDocument(): ?string
    {
        return $this->ioDocument;
    }

    public function getConsiderPersonalTargetingOnly(): bool
    {
        return $this->considerPersonalTargetingOnly;
    }

    public function getHostsOnly(): bool
    {
        return $this->hostsOnly;
    }

    public function getImpressionsLink(): ?string
    {
        return $this->impressionsLink;
    }

    public function getUniqIpOnly(): bool
    {
        return $this->uniqIpOnly;
    }

    public function getRejectNotUniqueIp(): bool
    {
        return $this->rejectNotUniqueIp;
    }
}
