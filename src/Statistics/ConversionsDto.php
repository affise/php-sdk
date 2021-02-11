<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ConversionsDto
*/
class ConversionsDto
{
    private string $id;
    private string $actionId;
    private string $status;
    private string $currency;
    private ?string $goal;
    private string $country;
    private ?string $district;
    private string $city;
    private string $ip;
    private string $browser;
    private string $os;
    private string $device;
    private ?OfferDto $offer;
    private int $offerId;
    private ?string $iosIdfa;
    private ?string $androidId;
    private string $sub1;
    private string $sub2;
    private string $sub3;
    private string $sub4;
    private string $sub5;
    private string $customField1;
    private string $customField2;
    private string $customField3;
    private string $customField4;
    private string $customField5;
    private string $customField6;
    private string $customField7;
    private string $ua;
    private string $comment;
    private string $createdAt;
    private string $clickTime;
    private string $referrer;
    private float $payouts;
    private string $clickId;
    private PartnerDto $partner;
    private string $goalValue;
    private float $sum;
    private float $revenue;
    private float $earnings;
    private AdvertiserDto $advertiser;
    private string $paymentStatus;
    private string $isPaid;
    private ?string $forensiq;
    private ?string $paymentType;
    private ?string $holdDateExpire;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->actionId = $attributes['action_id'];
        $this->status = $attributes['status'];
        $this->currency = $attributes['currency'];
        $this->goal = $attributes['goal'] ?? null;
        $this->country = $attributes['country'];
        $this->district = $attributes['district'] ?? null;
        $this->city = $attributes['city'];
        $this->ip = $attributes['ip'];
        $this->browser = $attributes['browser'];
        $this->os = $attributes['os'];
        $this->device = $attributes['device'];
        $this->offer = new OfferDto($attributes['offer']);
        $this->offerId = $attributes['offer_id'];
        $this->iosIdfa = $attributes['ios_idfa'] ?? null;
        $this->androidId = $attributes['android_id'] ?? null;
        $this->sub1 = $attributes['sub1'];
        $this->sub2 = $attributes['sub2'];
        $this->sub3 = $attributes['sub3'];
        $this->sub4 = $attributes['sub4'];
        $this->sub5 = $attributes['sub5'];
        $this->customField1 = $attributes['custom_field_1'];
        $this->customField2 = $attributes['custom_field_2'];
        $this->customField3 = $attributes['custom_field_3'];
        $this->customField4 = $attributes['custom_field_4'];
        $this->customField5 = $attributes['custom_field_5'];
        $this->customField6 = $attributes['custom_field_6'];
        $this->customField7 = $attributes['custom_field_7'];
        $this->ua = $attributes['ua'];
        $this->comment = $attributes['comment'];
        $this->createdAt = $attributes['created_at'];
        $this->clickTime = $attributes['click_time'];
        $this->referrer = $attributes['referrer'];
        $this->payouts = $attributes['payouts'];
        $this->clickId = $attributes['clickid'];
        $this->partner = new PartnerDto($attributes['partner']);
        $this->goalValue = $attributes['goal_value'];
        $this->sum = $attributes['sum'];
        $this->revenue = $attributes['revenue'];
        $this->earnings = $attributes['earnings'];
        $this->advertiser = new AdvertiserDto($attributes['advertiser']);
        $this->paymentStatus = $attributes['payment_status'];
        $this->isPaid = $attributes['is_paid'];
        $this->forensiq = $attributes['forensiq'] ?? null;
        $this->paymentType = $attributes['payment_type'] ?? null;
        $this->holdDateExpire = $attributes['hold_date_expire'] ?? null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getActionId(): string
    {
        return $this->actionId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getIp(): string
    {
        return $this->ip;
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

    public function getOffer(): ?OfferDto
    {
        return $this->offer;
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getIosIdfa(): ?string
    {
        return $this->iosIdfa;
    }

    public function getAndroidId(): ?string
    {
        return $this->androidId;
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

    public function getCustomField1(): string
    {
        return $this->customField1;
    }

    public function getCustomField2(): string
    {
        return $this->customField2;
    }

    public function getCustomField3(): string
    {
        return $this->customField3;
    }

    public function getCustomField4(): string
    {
        return $this->customField4;
    }

    public function getCustomField5(): string
    {
        return $this->customField5;
    }

    public function getCustomField6(): string
    {
        return $this->customField6;
    }

    public function getCustomField7(): string
    {
        return $this->customField7;
    }

    public function getUa(): string
    {
        return $this->ua;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getClickTime(): string
    {
        return $this->clickTime;
    }

    public function getReferrer(): string
    {
        return $this->referrer;
    }

    public function getPayouts(): float
    {
        return $this->payouts;
    }

    public function getClickId(): string
    {
        return $this->clickId;
    }

    public function getPartner(): PartnerDto
    {
        return $this->partner;
    }

    public function getGoalValue(): string
    {
        return $this->goalValue;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function getRevenue(): float
    {
        return $this->revenue;
    }

    public function getEarnings(): float
    {
        return $this->earnings;
    }

    public function getAdvertiser(): AdvertiserDto
    {
        return $this->advertiser;
    }

    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    public function getIsPaid(): string
    {
        return $this->isPaid;
    }

    public function getForensiq(): ?string
    {
        return $this->forensiq;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function getHoldDateExpire(): ?string
    {
        return $this->holdDateExpire;
    }
}
