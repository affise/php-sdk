<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class CityListDto
*/
class CityListDto
{
    private string $countryCode;
    private int $id;
    private string $name;
    private int $regionCode;
    private string $region;

    public function __construct(array $attributes)
    {
        $this->countryCode = $attributes['country_code'];
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->regionCode = $attributes['region_code'];
        $this->region = $attributes['region'];
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRegionCode(): int
    {
        return $this->regionCode;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
}
