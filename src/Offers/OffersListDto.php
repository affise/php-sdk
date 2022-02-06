<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class OffersListDto
*/
class OffersListDto extends BaseOfferDto
{
    protected string $advertiser;
    protected string $externalOfferId;
    protected string $bundleId;
    protected bool $hidePayments;
    protected string $url;
    protected string $crossPostbackUrl;
    protected string $urlPreview;
    protected string $domainUrl;
    protected string $trafficbackUrl;
    protected string $status;

    /**
    * @var array<mixed>
    */
    protected array $tags;
    protected string $privacy;
    protected int $isTop;

    /**
    * @var array<\Affise\Sdk\Offers\PartnerPaymentDto>
    */
    protected array $partnerPayments;
    protected ?string $strictlyConnectionType;
    protected bool $isRedirectOvercap;
    protected int $noticePercentOvercap;
    protected float $cr;
    protected float $epc;
    protected string $notes;
    protected string $allowedIp;
    protected string $disallowedIp;
    protected string $hashPassword;
    protected bool $allowDeeplink;
    protected ?bool $hideReferer;
    protected ?string $startAt;
    protected ?int $autoOfferConnect;
    protected string $createdAt;

    /**
    * @var array<array<string, mixed>>
    */
    protected array $subAccounts;

    /**
    * @var array<\Affise\Sdk\Offers\CommissionTierDto>
    */
    protected array $commissionTiers;
    protected string $updatedAt;
    protected bool $allowImpressions;

    /**
    * @var array<mixed>
    */
    protected array $smartlinkCategories;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
        
        $this->advertiser = $attributes['advertiser'];
        $this->externalOfferId = $attributes['external_offer_id'];
        $this->bundleId = $attributes['bundle_id'];
        $this->hidePayments = $attributes['hide_payments'];
        $this->url = $attributes['url'];
        $this->crossPostbackUrl = $attributes['cross_postback_url'];
        $this->urlPreview = $attributes['url_preview'];
        $this->domainUrl = $attributes['domain_url'];
        $this->trafficbackUrl = $attributes['trafficback_url'];
        $this->status = $attributes['status'];
        $this->tags = $attributes['tags'] ?? [];
        $this->privacy = $attributes['privacy'];
        $this->isTop = $attributes['is_top'];
        $this->partnerPayments = array_map(fn(array $item) => new PartnerPaymentDto($item), $attributes['partner_payments'] ?? []);
        $this->strictlyConnectionType = $attributes['strictly_connection_type'] ?? null;
        $this->isRedirectOvercap = $attributes['is_redirect_overcap'];
        $this->noticePercentOvercap = $attributes['notice_percent_overcap'];
        $this->cr = $attributes['cr'];
        $this->epc = $attributes['epc'];
        $this->notes = $attributes['notes'] ?? '';
        $this->allowedIp = $attributes['allowed_ip'];
        $this->disallowedIp = $attributes['disallowed_ip'];
        $this->hashPassword = $attributes['hash_password'];
        $this->allowDeeplink = (bool) $attributes['allow_deeplink'];
        $this->hideReferer = $attributes['hide_referer'] ?? null;
        $this->startAt = $attributes['start_at'] ?? null;
        $this->autoOfferConnect = $attributes['auto_offer_connect'] ?? null;
        $this->createdAt = $attributes['created_at'];
        $this->subAccounts = $attributes['sub_accounts'] ?? [];
        $this->commissionTiers = array_map(fn(array $item) => new CommissionTierDto($item), $attributes['commission_tiers'] ?? []);
        $this->updatedAt = $attributes['updated_at'];
        $this->allowImpressions = $attributes['allow_impressions'];
        $this->smartlinkCategories = $attributes['smartlink_categories'] ?? [];
    }

    public function getAdvertiser(): string
    {
        return $this->advertiser;
    }

    public function getExternalOfferId(): string
    {
        return $this->externalOfferId;
    }

    public function getBundleId(): string
    {
        return $this->bundleId;
    }

    public function getHidePayments(): bool
    {
        return $this->hidePayments;
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

    public function getDomainUrl(): string
    {
        return $this->domainUrl;
    }

    public function getTrafficbackUrl(): string
    {
        return $this->trafficbackUrl;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
    * @return array<mixed>
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
    * @return array<\Affise\Sdk\Offers\PartnerPaymentDto>
    */
    public function getPartnerPayments(): array
    {
        return $this->partnerPayments;
    }

    public function getStrictlyConnectionType(): ?string
    {
        return $this->strictlyConnectionType;
    }

    public function getIsRedirectOvercap(): bool
    {
        return $this->isRedirectOvercap;
    }

    public function getNoticePercentOvercap(): int
    {
        return $this->noticePercentOvercap;
    }

    public function getCr(): float
    {
        return $this->cr;
    }

    public function getEpc(): float
    {
        return $this->epc;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getAllowedIp(): string
    {
        return $this->allowedIp;
    }

    public function getDisallowedIp(): string
    {
        return $this->disallowedIp;
    }

    public function getHashPassword(): string
    {
        return $this->hashPassword;
    }

    public function getAllowDeeplink(): bool
    {
        return $this->allowDeeplink;
    }

    public function getHideReferer(): ?bool
    {
        return $this->hideReferer;
    }

    public function getStartAt(): ?string
    {
        return $this->startAt;
    }

    public function getAutoOfferConnect(): ?int
    {
        return $this->autoOfferConnect;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
    * @return array<array<string, mixed>>
    */
    public function getSubAccounts(): array
    {
        return $this->subAccounts;
    }

    /**
    * @return array<\Affise\Sdk\Offers\CommissionTierDto>
    */
    public function getCommissionTiers(): array
    {
        return $this->commissionTiers;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getAllowImpressions(): bool
    {
        return $this->allowImpressions;
    }

    /**
    * @return array<mixed>
    */
    public function getSmartlinkCategories(): array
    {
        return $this->smartlinkCategories;
    }
}
