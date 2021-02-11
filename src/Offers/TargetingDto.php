<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class TargetingDto
*/
class TargetingDto
{

    /**
    * @var array<string, array<mixed>>
    */
    private array $country;

    /**
    * @var array<string, array<mixed>>
    */
    private array $region;

    /**
    * @var array<string, array<mixed>>
    */
    private array $city;

    /**
    * @var array<string, array<mixed>>
    */
    private array $os;

    /**
    * @var array<string, array<mixed>>
    */
    private array $isp;

    /**
    * @var array<string, array<mixed>>
    */
    private array $ip;

    /**
    * @var array<string, array<mixed>>
    */
    private array $browser;

    /**
    * @var array<string, array<mixed>>
    */
    private array $brand;

    /**
    * @var array<mixed>
    */
    private array $deviceType;

    /**
    * @var array<mixed>
    */
    private array $connection;

    /**
    * @var array<mixed>
    */
    private array $affiliateId;

    /**
    * @var array<string, array<mixed>>
    */
    private array $sub;

    public function __construct(array $attributes)
    {
        $this->country = $attributes['country'] ?? [];
        $this->region = $attributes['region'] ?? [];
        $this->city = $attributes['city'] ?? [];
        $this->os = $attributes['os'] ?? [];
        $this->isp = $attributes['isp'] ?? [];
        $this->ip = $attributes['ip'] ?? [];
        $this->browser = $attributes['browser'] ?? [];
        $this->brand = $attributes['brand'] ?? [];
        $this->deviceType = $attributes['device_type'] ?? [];
        $this->connection = $attributes['connection'] ?? [];
        $this->affiliateId = $attributes['affiliate_id'] ?? [];
        $this->sub = $attributes['sub'] ?? [];
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getCountry(): array
    {
        return $this->country;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getRegion(): array
    {
        return $this->region;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getCity(): array
    {
        return $this->city;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getOs(): array
    {
        return $this->os;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getIsp(): array
    {
        return $this->isp;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getIp(): array
    {
        return $this->ip;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getBrowser(): array
    {
        return $this->browser;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getBrand(): array
    {
        return $this->brand;
    }

    /**
    * @return array<mixed>
    */
    public function getDeviceType(): array
    {
        return $this->deviceType;
    }

    /**
    * @return array<mixed>
    */
    public function getConnection(): array
    {
        return $this->connection;
    }

    /**
    * @return array<mixed>
    */
    public function getAffiliateId(): array
    {
        return $this->affiliateId;
    }

    /**
    * @return array<string, array<mixed>>
    */
    public function getSub(): array
    {
        return $this->sub;
    }
}
