<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ClicksDto
*/
class ClicksDto
{
    private string $id;
    private string $ip;
    private string $ua;
    private string $country;
    private string $city;
    private string $device;
    private string $os;
    private string $browser;
    private string $referrer;
    private string $sub1;
    private string $sub2;
    private string $sub3;
    private string $sub4;
    private string $sub5;
    private OfferDto $offer;
    private string $conversionId;
    private string $iosIdfa;
    private string $androidId;
    private string $createdAt;
    private int $uniq;
    private string $cbid;
    private string $partnerId;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->ip = $attributes['ip'];
        $this->ua = $attributes['ua'];
        $this->country = $attributes['country'];
        $this->city = $attributes['city'];
        $this->device = $attributes['device'];
        $this->os = $attributes['os'];
        $this->browser = $attributes['browser'];
        $this->referrer = $attributes['referrer'];
        $this->sub1 = $attributes['sub1'];
        $this->sub2 = $attributes['sub2'];
        $this->sub3 = $attributes['sub3'];
        $this->sub4 = $attributes['sub4'];
        $this->sub5 = $attributes['sub5'];
        $this->offer = new OfferDto($attributes['offer']);
        $this->conversionId = $attributes['conversion_id'];
        $this->iosIdfa = $attributes['ios_idfa'];
        $this->androidId = $attributes['android_id'];
        $this->createdAt = $attributes['created_at'];
        $this->uniq = $attributes['uniq'];
        $this->cbid = $attributes['cbid'];
        $this->partnerId = $attributes['partner_id'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getUa(): string
    {
        return $this->ua;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function getOs(): string
    {
        return $this->os;
    }

    public function getBrowser(): string
    {
        return $this->browser;
    }

    public function getReferrer(): string
    {
        return $this->referrer;
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

    public function getOffer(): OfferDto
    {
        return $this->offer;
    }

    public function getConversionId(): string
    {
        return $this->conversionId;
    }

    public function getIosIdfa(): string
    {
        return $this->iosIdfa;
    }

    public function getAndroidId(): string
    {
        return $this->androidId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUniq(): int
    {
        return $this->uniq;
    }

    public function getCbid(): string
    {
        return $this->cbid;
    }

    public function getPartnerId(): string
    {
        return $this->partnerId;
    }
}
