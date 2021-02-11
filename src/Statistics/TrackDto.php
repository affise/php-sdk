<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class TrackDto
*/
class TrackDto
{
    private string $id;
    private string $createdAt;
    private string $ip;
    private string $ua;
    private string $sub1;
    private string $sub2;
    private string $sub3;
    private string $sub4;
    private string $sub5;
    private string $sub6;
    private string $sub7;
    private string $sub8;
    private OfferDto $offer;
    private int $partnerId;
    private string $browser;
    private string $browserVersion;
    private string $browserFullname;
    private string $os;
    private string $osVersion;
    private string $osFullname;
    private string $device;
    private string $deviceFullname;
    private string $deviceModel;
    private string $deviceType;
    private string $city;
    private string $country;
    private int $cityId;
    private ?string $district;
    private string $connectionType;
    private string $ispCode;
    private string $referrer;
    private ?string $landingId;
    private ?string $prelandingId;
    private string $smartId;
    private LandingDto $landing;
    private LandingDto $prelanding;
    private string $refId;
    private string $osId;
    private string $userId;
    private string $ext1;
    private string $ext2;
    private string $ext3;
    private ?string $countryName;
    private ?string $clickId;
    private ?string $conversionId;
    private ?bool $hasConversions;
    private ?string $cbid;
    private ?string $idfa;
    private ?int $isp;
    private ?bool $uniq;
    private PostbackPartnerDto $partner;
    private ?string $supplierManagerId;
    private ?string $unid;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->createdAt = $attributes['created_at'];
        $this->ip = $attributes['ip'];
        $this->ua = $attributes['ua'];
        $this->sub1 = $attributes['sub1'];
        $this->sub2 = $attributes['sub2'];
        $this->sub3 = $attributes['sub3'];
        $this->sub4 = $attributes['sub4'];
        $this->sub5 = $attributes['sub5'];
        $this->sub6 = $attributes['sub6'];
        $this->sub7 = $attributes['sub7'];
        $this->sub8 = $attributes['sub8'];
        $this->offer = new OfferDto($attributes['offer']);
        $this->partnerId = $attributes['partner_id'];
        $this->browser = $attributes['browser'];
        $this->browserVersion = $attributes['browser_version'];
        $this->browserFullname = $attributes['browser_fullname'];
        $this->os = $attributes['os'];
        $this->osVersion = $attributes['os_version'];
        $this->osFullname = $attributes['os_fullname'];
        $this->device = $attributes['device'];
        $this->deviceFullname = $attributes['device_fullname'];
        $this->deviceModel = $attributes['device_model'];
        $this->deviceType = $attributes['device_type'];
        $this->city = $attributes['city'];
        $this->country = $attributes['country'];
        $this->cityId = $attributes['city_id'];
        $this->district = $attributes['district'] ?? null;
        $this->connectionType = $attributes['connection_type'];
        $this->ispCode = $attributes['isp_code'];
        $this->referrer = $attributes['referrer'];
        $this->landingId = $attributes['landing_id'] ?? null;
        $this->prelandingId = $attributes['prelanding_id'] ?? null;
        $this->smartId = $attributes['smart_id'];
        $this->landing = new LandingDto($attributes['landing']);
        $this->prelanding = new LandingDto($attributes['prelanding']);
        $this->refId = $attributes['ref_id'];
        $this->osId = $attributes['os_id'];
        $this->userId = $attributes['user_id'];
        $this->ext1 = $attributes['ext1'];
        $this->ext2 = $attributes['ext2'];
        $this->ext3 = $attributes['ext3'];
        $this->countryName = $attributes['country_name'] ?? null;
        $this->clickId = $attributes['click_id'] ?? null;
        $this->conversionId = $attributes['conversion_id'] ?? null;
        $this->hasConversions = $attributes['has_conversions'] ?? null;
        $this->cbid = $attributes['cbid'] ?? null;
        $this->idfa = $attributes['idfa'] ?? null;
        $this->isp = $attributes['isp'] ?? null;
        $this->uniq = $attributes['uniq'] ?? null;
        $this->partner = new PostbackPartnerDto($attributes['partner']);
        $this->supplierManagerId = $attributes['supplier_manager_id'] ?? null;
        $this->unid = $attributes['unid'] ?? null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getUa(): string
    {
        return $this->ua;
    }

    public function getSub1(): string
    {
        return $this->sub1;
    }

    public function getSub2(): string
    {
        return $this->sub2;
    }

    public function getSub3(): string
    {
        return $this->sub3;
    }

    public function getSub4(): string
    {
        return $this->sub4;
    }

    public function getSub5(): string
    {
        return $this->sub5;
    }

    public function getSub6(): string
    {
        return $this->sub6;
    }

    public function getSub7(): string
    {
        return $this->sub7;
    }

    public function getSub8(): string
    {
        return $this->sub8;
    }

    public function getOffer(): OfferDto
    {
        return $this->offer;
    }

    public function getPartnerId(): int
    {
        return $this->partnerId;
    }

    public function getBrowser(): string
    {
        return $this->browser;
    }

    public function getBrowserVersion(): string
    {
        return $this->browserVersion;
    }

    public function getBrowserFullname(): string
    {
        return $this->browserFullname;
    }

    public function getOs(): string
    {
        return $this->os;
    }

    public function getOsVersion(): string
    {
        return $this->osVersion;
    }

    public function getOsFullname(): string
    {
        return $this->osFullname;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function getDeviceFullname(): string
    {
        return $this->deviceFullname;
    }

    public function getDeviceModel(): string
    {
        return $this->deviceModel;
    }

    public function getDeviceType(): string
    {
        return $this->deviceType;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getConnectionType(): string
    {
        return $this->connectionType;
    }

    public function getIspCode(): string
    {
        return $this->ispCode;
    }

    public function getReferrer(): string
    {
        return $this->referrer;
    }

    public function getLandingId(): ?string
    {
        return $this->landingId;
    }

    public function getPrelandingId(): ?string
    {
        return $this->prelandingId;
    }

    public function getSmartId(): string
    {
        return $this->smartId;
    }

    public function getLanding(): LandingDto
    {
        return $this->landing;
    }

    public function getPrelanding(): LandingDto
    {
        return $this->prelanding;
    }

    public function getRefId(): string
    {
        return $this->refId;
    }

    public function getOsId(): string
    {
        return $this->osId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getExt1(): string
    {
        return $this->ext1;
    }

    public function getExt2(): string
    {
        return $this->ext2;
    }

    public function getExt3(): string
    {
        return $this->ext3;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function getClickId(): ?string
    {
        return $this->clickId;
    }

    public function getConversionId(): ?string
    {
        return $this->conversionId;
    }

    public function getHasConversions(): ?bool
    {
        return $this->hasConversions;
    }

    public function getCbid(): ?string
    {
        return $this->cbid;
    }

    public function getIdfa(): ?string
    {
        return $this->idfa;
    }

    public function getIsp(): ?int
    {
        return $this->isp;
    }

    public function getUniq(): ?bool
    {
        return $this->uniq;
    }

    public function getPartner(): PostbackPartnerDto
    {
        return $this->partner;
    }

    public function getSupplierManagerId(): ?string
    {
        return $this->supplierManagerId;
    }

    public function getUnid(): ?string
    {
        return $this->unid;
    }
}
