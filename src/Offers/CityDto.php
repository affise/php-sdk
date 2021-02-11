<?php

declare(strict_types=1);

namespace Affise\Sdk\Offers;

/**
* Class CityDto
*/
class CityDto
{
    private string $countryCode;
    private int $id;
    private string $name;
    private int $regionCode;

    public function __construct(array $attributes)
    {
        $this->countryCode = $attributes['country_code'];
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->regionCode = $attributes['region_code'];
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
}
