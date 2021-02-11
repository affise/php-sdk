<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

/**
* Class EditOfferDto
*/
class EditOfferDto
{
    private int $id;
    private string $offerId;
    private string $advertiser;
    private bool $hidePayments;
    private string $title;
    private ?string $macroUrl;
    private string $url;
    private string $crossPostbackUrl;
    private string $urlPreview;
    private string $previewUrl;
    private string $domainUrl;
    private bool $useHttps;
    private bool $useHttp;

    /**
    * @var array<string, string>
    */
    private array $descriptionLang;

    /**
    * @var array<mixed>
    */
    private array $sources;
    private string $logo;
    private string $status;

    /**
    * @var array<string>
    */
    private array $tags;
    private string $privacy;
    private int $isTop;

    /**
    * @var array<mixed>
    */
    private array $payments;

    /**
    * @var array<mixed>
    */
    private array $partnerPayments;

    /**
    * @var array<mixed>
    */
    private array $landings;
    private int $strictlyCountry;

    /**
    * @var array<mixed>
    */
    private array $strictlyOs;
    private string $strictlyConnectionType;
    private bool $isRedirectOvercap;
    private ?string $noticePercentOvercap;
    private int $holdPeriod;

    /**
    * @var array<mixed>
    */
    private array $categories;

    /**
    * @var array<mixed>
    */
    private array $fullCategories;
    private int $cr;
    private int $epc;
    private ?string $notes;
    private string $allowedIp;
    private ?string $hashPassword;
    private int $allowDeeplink;
    private int $hideReferer;
    private string $startAt;
    private ?string $stopAt;
    private ?string $autoOfferConnect;
    private bool $requiredApproval;
    private bool $isCpi;

    /**
    * @var array<mixed>
    */
    private array $creatives;
    private ?string $creativesZip;

    /**
    * @var array<string>
    */
    private array $smartlinkCategories;
    private string $clickSession;
    private string $minimalClickSession;

    /**
    * @var array<array<string, string>>
    */
    private array $subRestrictions;
    private string $capsTimezone;

    /**
    * @var array<string>
    */
    private array $strictlyIsp;
    private int $hideCaps;

    /**
    * @var array<string>
    */
    private array $capsStatus;
    private string $capsGoalOvercap;

    /**
    * @var array<\Affise\Sdk\OfferManaging\CommissionTierDto>
    */
    private array $commissionTiers;
    private bool $considerPersonalTargetingOnly;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->offerId = $attributes['offer_id'];
        $this->advertiser = $attributes['advertiser'];
        $this->hidePayments = $attributes['hide_payments'];
        $this->title = $attributes['title'];
        $this->macroUrl = $attributes['macro_url'] ?? null;
        $this->url = $attributes['url'];
        $this->crossPostbackUrl = $attributes['cross_postback_url'];
        $this->urlPreview = $attributes['url_preview'];
        $this->previewUrl = $attributes['preview_url'];
        $this->domainUrl = $attributes['domain_url'];
        $this->useHttps = $attributes['use_https'];
        $this->useHttp = $attributes['use_http'];
        $this->descriptionLang = $attributes['description_lang'] ?? [];
        $this->sources = $attributes['sources'] ?? [];
        $this->logo = $attributes['logo'];
        $this->status = $attributes['status'];
        $this->tags = $attributes['tags'] ?? [];
        $this->privacy = $attributes['privacy'];
        $this->isTop = $attributes['is_top'];
        $this->payments = $attributes['payments'] ?? [];
        $this->partnerPayments = $attributes['partner_payments'] ?? [];
        $this->landings = $attributes['landings'] ?? [];
        $this->strictlyCountry = $attributes['strictly_country'];
        $this->strictlyOs = $attributes['strictly_os'] ?? [];
        $this->strictlyConnectionType = $attributes['strictly_connection_type'];
        $this->isRedirectOvercap = $attributes['is_redirect_overcap'];
        $this->noticePercentOvercap = $attributes['notice_percent_overcap'] ?? null;
        $this->holdPeriod = $attributes['hold_period'];
        $this->categories = $attributes['categories'] ?? [];
        $this->fullCategories = $attributes['full_categories'] ?? [];
        $this->cr = $attributes['cr'];
        $this->epc = $attributes['epc'];
        $this->notes = $attributes['notes'] ?? null;
        $this->allowedIp = $attributes['allowed_ip'];
        $this->hashPassword = $attributes['hash_password'] ?? null;
        $this->allowDeeplink = $attributes['allow_deeplink'];
        $this->hideReferer = $attributes['hide_referer'];
        $this->startAt = $attributes['start_at'];
        $this->stopAt = $attributes['stop_at'] ?? null;
        $this->autoOfferConnect = $attributes['auto_offer_connect'] ?? null;
        $this->requiredApproval = $attributes['required_approval'];
        $this->isCpi = $attributes['is_cpi'];
        $this->creatives = $attributes['creatives'] ?? [];
        $this->creativesZip = $attributes['creatives_zip'] ?? null;
        $this->smartlinkCategories = $attributes['smartlink_categories'] ?? [];
        $this->clickSession = $attributes['click_session'];
        $this->minimalClickSession = $attributes['minimal_click_session'];
        $this->subRestrictions = $attributes['sub_restrictions'] ?? [];
        $this->capsTimezone = $attributes['caps_timezone'];
        $this->strictlyIsp = $attributes['strictly_isp'] ?? [];
        $this->hideCaps = $attributes['hide_caps'];
        $this->capsStatus = $attributes['caps_status'] ?? [];
        $this->capsGoalOvercap = $attributes['caps_goal_overcap'];
        $this->commissionTiers = array_map(fn(array $item) => new CommissionTierDto($item), $attributes['commission_tiers'] ?? []);
        $this->considerPersonalTargetingOnly = $attributes['consider_personal_targeting_only'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOfferId(): string
    {
        return $this->offerId;
    }

    public function getAdvertiser(): string
    {
        return $this->advertiser;
    }

    public function getHidePayments(): bool
    {
        return $this->hidePayments;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMacroUrl(): ?string
    {
        return $this->macroUrl;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCrossPostbackUrl(): string
    {
        return $this->crossPostbackUrl;
    }

    public function getUrlPreview(): string
    {
        return $this->urlPreview;
    }

    public function getPreviewUrl(): string
    {
        return $this->previewUrl;
    }

    public function getDomainUrl(): string
    {
        return $this->domainUrl;
    }

    public function getUseHttps(): bool
    {
        return $this->useHttps;
    }

    public function getUseHttp(): bool
    {
        return $this->useHttp;
    }

    /**
    * @return array<string, string>
    */
    public function getDescriptionLang(): array
    {
        return $this->descriptionLang;
    }

    /**
    * @return array<mixed>
    */
    public function getSources(): array
    {
        return $this->sources;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
    * @return array<string>
    */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function getPrivacy(): string
    {
        return $this->privacy;
    }

    public function getIsTop(): int
    {
        return $this->isTop;
    }

    /**
    * @return array<mixed>
    */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
    * @return array<mixed>
    */
    public function getPartnerPayments(): array
    {
        return $this->partnerPayments;
    }

    /**
    * @return array<mixed>
    */
    public function getLandings(): array
    {
        return $this->landings;
    }

    public function getStrictlyCountry(): int
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

    public function getStrictlyConnectionType(): string
    {
        return $this->strictlyConnectionType;
    }

    public function getIsRedirectOvercap(): bool
    {
        return $this->isRedirectOvercap;
    }

    public function getNoticePercentOvercap(): ?string
    {
        return $this->noticePercentOvercap;
    }

    public function getHoldPeriod(): int
    {
        return $this->holdPeriod;
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

    public function getCr(): int
    {
        return $this->cr;
    }

    public function getEpc(): int
    {
        return $this->epc;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function getAllowedIp(): string
    {
        return $this->allowedIp;
    }

    public function getHashPassword(): ?string
    {
        return $this->hashPassword;
    }

    public function getAllowDeeplink(): int
    {
        return $this->allowDeeplink;
    }

    public function getHideReferer(): int
    {
        return $this->hideReferer;
    }

    public function getStartAt(): string
    {
        return $this->startAt;
    }

    public function getStopAt(): ?string
    {
        return $this->stopAt;
    }

    public function getAutoOfferConnect(): ?string
    {
        return $this->autoOfferConnect;
    }

    public function getRequiredApproval(): bool
    {
        return $this->requiredApproval;
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
    * @return array<string>
    */
    public function getSmartlinkCategories(): array
    {
        return $this->smartlinkCategories;
    }

    public function getClickSession(): string
    {
        return $this->clickSession;
    }

    public function getMinimalClickSession(): string
    {
        return $this->minimalClickSession;
    }

    /**
    * @return array<array<string, string>>
    */
    public function getSubRestrictions(): array
    {
        return $this->subRestrictions;
    }

    public function getCapsTimezone(): string
    {
        return $this->capsTimezone;
    }

    /**
    * @return array<string>
    */
    public function getStrictlyIsp(): array
    {
        return $this->strictlyIsp;
    }

    public function getHideCaps(): int
    {
        return $this->hideCaps;
    }

    /**
    * @return array<string>
    */
    public function getCapsStatus(): array
    {
        return $this->capsStatus;
    }

    public function getCapsGoalOvercap(): string
    {
        return $this->capsGoalOvercap;
    }

    /**
    * @return array<\Affise\Sdk\OfferManaging\CommissionTierDto>
    */
    public function getCommissionTiers(): array
    {
        return $this->commissionTiers;
    }

    public function getConsiderPersonalTargetingOnly(): bool
    {
        return $this->considerPersonalTargetingOnly;
    }
}
