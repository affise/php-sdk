<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ConversionDto
*/
class ConversionDto
{
    private string $id;
    private string $actionId;
    private int $status;
    private string $conversionId;
    private string $cbid;
    private string $currency;
    private ?OfferDto $offer;
    private int $offerId;
    private string $goal;
    private ?string $holdDateExpire;
    private string $ip;
    private string $country;
    private string $countryName;
    private ?string $district;
    private string $city;
    private int $cityId;
    private string $ispCode;
    private string $ua;
    private string $browser;
    private string $os;
    private string $device;
    private string $deviceType;
    private ?string $sub1;
    private ?string $sub2;
    private ?string $sub3;
    private ?string $sub4;
    private ?string $sub5;
    private ?string $sub6;
    private ?string $sub7;
    private ?string $sub8;
    private ?string $customField1;
    private ?string $customField2;
    private ?string $customField3;
    private ?string $customField4;
    private ?string $customField5;
    private ?string $customField6;
    private ?string $customField7;
    private ?string $comment;
    private string $clickTime;
    private ?string $referrer;
    private ?string $landingId;
    private ?string $prelandingId;
    private string $createdAt;
    private string $updatedAt;
    private ?string $currencyId;
    private ?string $price;
    private PartnerDto $partner;
    private string $supplierId;
    private int $partnerId;
    private string $goalValue;
    private int $sum;
    private int $revenue;
    private int $payouts;
    private int $earnings;
    private AdvertiserDto $advertiser;
    private string $paymentType;
    private string $paymentStatus;
    private string $isPaid;
    private int $charge;
    private int $earning;
    private string $clickId;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->actionId = $attributes['action_id'];
        $this->status = $attributes['status'];
        $this->conversionId = $attributes['conversion_id'];
        $this->cbid = $attributes['cbid'];
        $this->currency = $attributes['currency'];
        $this->offer = empty($attributes['offer']) ? null : new OfferDto($attributes['offer']);
        $this->offerId = $attributes['offer_id'];
        $this->goal = $attributes['goal'];
        $this->holdDateExpire = $attributes['hold_date_expire'] ?? null;
        $this->ip = $attributes['ip'];
        $this->country = $attributes['country'];
        $this->countryName = $attributes['country_name'];
        $this->district = $attributes['district'] ?? null;
        $this->city = $attributes['city'];
        $this->cityId = $attributes['city_id'];
        $this->ispCode = $attributes['isp_code'];
        $this->ua = $attributes['ua'];
        $this->browser = $attributes['browser'];
        $this->os = $attributes['os'];
        $this->device = $attributes['device'];
        $this->deviceType = $attributes['device_type'];
        $this->sub1 = $attributes['sub1'] ?? null;
        $this->sub2 = $attributes['sub2'] ?? null;
        $this->sub3 = $attributes['sub3'] ?? null;
        $this->sub4 = $attributes['sub4'] ?? null;
        $this->sub5 = $attributes['sub5'] ?? null;
        $this->sub6 = $attributes['sub6'] ?? null;
        $this->sub7 = $attributes['sub7'] ?? null;
        $this->sub8 = $attributes['sub8'] ?? null;
        $this->customField1 = $attributes['custom_field_1'] ?? null;
        $this->customField2 = $attributes['custom_field_2'] ?? null;
        $this->customField3 = $attributes['custom_field_3'] ?? null;
        $this->customField4 = $attributes['custom_field_4'] ?? null;
        $this->customField5 = $attributes['custom_field_5'] ?? null;
        $this->customField6 = $attributes['custom_field_6'] ?? null;
        $this->customField7 = $attributes['custom_field_7'] ?? null;
        $this->comment = $attributes['comment'] ?? null;
        $this->clickTime = $attributes['click_time'];
        $this->referrer = $attributes['referrer'] ?? null;
        $this->landingId = $attributes['landing_id'] ?? null;
        $this->prelandingId = $attributes['prelanding_id'] ?? null;
        $this->createdAt = $attributes['createdAt'];
        $this->updatedAt = $attributes['updatedAt'];
        $this->currencyId = $attributes['currency_id'] ?? null;
        $this->price = $attributes['price'] ?? null;
        $this->partner = new PartnerDto($attributes['partner']);
        $this->supplierId = $attributes['supplier_id'];
        $this->partnerId = $attributes['partner_id'];
        $this->goalValue = $attributes['goal_value'];
        $this->sum = $attributes['sum'];
        $this->revenue = $attributes['revenue'];
        $this->payouts = $attributes['payouts'];
        $this->earnings = $attributes['earnings'];
        $this->advertiser = new AdvertiserDto($attributes['advertiser']);
        $this->paymentType = $attributes['payment_type'];
        $this->paymentStatus = $attributes['payment_status'];
        $this->isPaid = $attributes['is_paid'];
        $this->charge = $attributes['charge'];
        $this->earning = $attributes['earning'];
        $this->clickId = $attributes['click_id'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getActionId(): string
    {
        return $this->actionId;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getConversionId(): string
    {
        return $this->conversionId;
    }

    public function getCbid(): string
    {
        return $this->cbid;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getOffer(): ?OfferDto
    {
        return $this->offer;
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getGoal(): string
    {
        return $this->goal;
    }

    public function getHoldDateExpire(): ?string
    {
        return $this->holdDateExpire;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getIspCode(): string
    {
        return $this->ispCode;
    }

    public function getUa(): string
    {
        return $this->ua;
    }

    public function getBrowser(): string
    {
        return $this->browser;
    }

    public function getOs(): string
    {
        return $this->os;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function getDeviceType(): string
    {
        return $this->deviceType;
    }

    public function getSub1(): ?string
    {
        return $this->sub1;
    }

    public function getSub2(): ?string
    {
        return $this->sub2;
    }

    public function getSub3(): ?string
    {
        return $this->sub3;
    }

    public function getSub4(): ?string
    {
        return $this->sub4;
    }

    public function getSub5(): ?string
    {
        return $this->sub5;
    }

    public function getSub6(): ?string
    {
        return $this->sub6;
    }

    public function getSub7(): ?string
    {
        return $this->sub7;
    }

    public function getSub8(): ?string
    {
        return $this->sub8;
    }

    public function getCustomField1(): ?string
    {
        return $this->customField1;
    }

    public function getCustomField2(): ?string
    {
        return $this->customField2;
    }

    public function getCustomField3(): ?string
    {
        return $this->customField3;
    }

    public function getCustomField4(): ?string
    {
        return $this->customField4;
    }

    public function getCustomField5(): ?string
    {
        return $this->customField5;
    }

    public function getCustomField6(): ?string
    {
        return $this->customField6;
    }

    public function getCustomField7(): ?string
    {
        return $this->customField7;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getClickTime(): string
    {
        return $this->clickTime;
    }

    public function getReferrer(): ?string
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getCurrencyId(): ?string
    {
        return $this->currencyId;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function getPartner(): PartnerDto
    {
        return $this->partner;
    }

    public function getSupplierId(): string
    {
        return $this->supplierId;
    }

    public function getPartnerId(): int
    {
        return $this->partnerId;
    }

    public function getGoalValue(): string
    {
        return $this->goalValue;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function getRevenue(): int
    {
        return $this->revenue;
    }

    public function getPayouts(): int
    {
        return $this->payouts;
    }

    public function getEarnings(): int
    {
        return $this->earnings;
    }

    public function getAdvertiser(): AdvertiserDto
    {
        return $this->advertiser;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    public function getIsPaid(): string
    {
        return $this->isPaid;
    }

    public function getCharge(): int
    {
        return $this->charge;
    }

    public function getEarning(): int
    {
        return $this->earning;
    }

    public function getClickId(): string
    {
        return $this->clickId;
    }
}
