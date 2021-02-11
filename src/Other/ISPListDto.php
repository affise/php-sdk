<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

/**
* Class ISPListDto
*/
class ISPListDto
{
    private string $country;
    private string $name;

    public function __construct(array $attributes)
    {
        $this->country = $attributes['country'];
        $this->name = $attributes['name'];
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
