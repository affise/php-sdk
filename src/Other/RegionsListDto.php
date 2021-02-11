<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

/**
* Class RegionsListDto
*/
class RegionsListDto
{
    private int $id;
    private string $name;
    private string $countryCode;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->countryCode = $attributes['country_code'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
