<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class BaseOfferDto
*/
class BaseOfferDto
{
    protected int $id;
    protected string $offerId;
    protected string $title;
    protected string $previewUrl;

    /**
    * @var array<string,string>
    */
    protected array $descriptionLang;
    protected string $logo;
    protected string $logoSource;
    protected ?string $stopAt;

    /**
    * @var array<\Affise\Sdk\Offers\SourceDto|string>
    */
    protected array $sources = [];

    /**
    * @var array<string>
    */
    protected array $categories;

    /**
    * @var array<\Affise\Sdk\Offers\FullCategoryDto>
    */
    protected array $fullCategories;

    /**
    * @var array<\Affise\Sdk\Offers\PaymentDto>
    */
    protected array $payments;

    /**
    * @var array<\Affise\Sdk\Offers\CapDto>
    */
    protected array $caps;
    protected bool $requiredApproval;
    protected ?int $strictlyCountry;

    /**
    * @var array<mixed>
    */
    protected array $strictlyOs;

    /**
    * @var array<mixed>
    */
    protected array $strictlyBrands;
    protected bool $isCpi;

    /**
    * @var array<mixed>
    */
    protected array $creatives;
    protected ?string $creativesZip;

    /**
    * @var array<\Affise\Sdk\Offers\LandingDto>
    */
    protected array $landings;
    protected ?string $macroUrl;
    protected bool $useHttps;
    protected bool $useHttp;
    protected int $holdPeriod;

    /**
    * @var array<string,string>
    */
    protected array $kpi;

    /**
    * @var array<mixed>
    */
    protected array $strictlyIsp;

    /**
    * @var array<string>|null
    */
    protected ?array $restrictionIsp;

    /**
    * @var array<\Affise\Sdk\Offers\TargetingDto>
    */
    protected array $targeting;

    /**
     * @var bool
     */
    protected $uniqIpOnly;

    /**
     * @var string|bool
     */
    protected $rejectNotUniqIp;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->offerId = $attributes['offer_id'];
        $this->title = $attributes['title'];
        $this->previewUrl = $attributes['preview_url'];
        $this->descriptionLang = $attributes['description_lang'] ?? [];
        $this->logo = $attributes['logo'];
        $this->logoSource = $attributes['logo_source'];
        $this->stopAt = $attributes['stop_at'] ?? null;
        $this->setSources($attributes['sources'] ?? []);
        $this->categories = $attributes['categories'] ?? [];
        $this->fullCategories = array_map(fn(array $item) => new FullCategoryDto($item), $attributes['full_categories'] ?? []);
        $this->payments = array_map(fn(array $item) => new PaymentDto($item), $attributes['payments'] ?? []);
        $this->caps = array_map(fn(array $item) => new CapDto($item), $attributes['caps'] ?? []);
        $this->requiredApproval = $attributes['required_approval'];
        $this->strictlyCountry = $attributes['strictly_country'] ?? null;
        $this->strictlyOs = $attributes['strictly_os'] ?? [];
        $this->strictlyBrands = $attributes['strictly_brands'] ?? [];
        $this->isCpi = $attributes['is_cpi'];
        $this->creatives = $attributes['creatives'] ?? [];
        $this->creativesZip = $attributes['creatives_zip'] ?? null;
        $this->landings = array_map(fn(array $item) => new LandingDto($item), $attributes['landings'] ?? []);
        $this->macroUrl = $attributes['macro_url'] ?? null;
        $this->useHttps = $attributes['use_https'];
        $this->useHttp = $attributes['use_http'];
        $this->holdPeriod = $attributes['hold_period'];
        $this->kpi = $attributes['kpi'] ?? [];
        $this->strictlyIsp = $attributes['strictly_isp'] ?? [];
        $this->restrictionIsp = $attributes['restriction_isp'] ?? null;
        $this->targeting = array_map(fn(array $item) => new TargetingDto($item), $attributes['targeting'] ?? []);
        $this->uniqIpOnly = $attributes['uniq_ip_only'];
        $this->rejectNotUniqIp = $attributes['reject_not_uniq_ip'] ?? null;
    }

    /**
     * @param array<array<string, mixed>|string> $sources
     *
     * @return void
     *
     * @psalm-suppress InvalidPropertyAssignmentValue
     * @psalm-suppress PossiblyInvalidArgument
     */
    protected function setSources(array $sources): void
    {
        $index = array_key_first($sources);

        if ($index !== null && is_string($sources[$index])) {
            $this->sources = $sources;
        } else {
            $this->sources = array_map(fn(array $item) => new SourceDto($item), $sources);
        }
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

    /**
    * @return array<string,string>
    */
    public function getDescriptionLang(): array
    {
        return $this->descriptionLang;
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
    * @return array<\Affise\Sdk\Offers\SourceDto|string>
    */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
    * @return array<string>
    */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
    * @return array<\Affise\Sdk\Offers\FullCategoryDto>
    */
    public function getFullCategories(): array
    {
        return $this->fullCategories;
    }

    /**
    * @return array<\Affise\Sdk\Offers\PaymentDto>
    */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
    * @return array<\Affise\Sdk\Offers\CapDto>
    */
    public function getCaps(): array
    {
        return $this->caps;
    }

    public function getRequiredApproval(): bool
    {
        return $this->requiredApproval;
    }

    public function getStrictlyCountry(): ?int
    {
        return $this->strictlyCountry;
    }

    /**
    * @return array<mixed>
    */
    public function getStrictlyOs(): array
    {
        return $this->strictlyOs;
    }

    /**
    * @return array<mixed>
    */
    public function getStrictlyBrands(): array
    {
        return $this->strictlyBrands;
    }

    public function getIsCpi(): bool
    {
        return $this->isCpi;
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
    * @return array<\Affise\Sdk\Offers\LandingDto>
    */
    public function getLandings(): array
    {
        return $this->landings;
    }

    public function getMacroUrl(): ?string
    {
        return $this->macroUrl;
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

    /**
    * @return array<string,string>
    */
    public function getKpi(): array
    {
        return $this->kpi;
    }

    /**
    * @return array<mixed>
    */
    public function getStrictlyIsp(): array
    {
        return $this->strictlyIsp;
    }

    /**
    * @return array<string>|null
    */
    public function getRestrictionIsp(): ?array
    {
        return $this->restrictionIsp;
    }

    /**
    * @return array<\Affise\Sdk\Offers\TargetingDto>
    */
    public function getTargeting(): array
    {
        return $this->targeting;
    }

    /**
     * @return bool
     */
    public function getUniqIpOnly()
    {
        return $this->uniqIpOnly;
    }

    /**
     * @return bool|string
     */
    public function getRejectNotUniqIp()
    {
        return $this->rejectNotUniqIp;
    }
}
