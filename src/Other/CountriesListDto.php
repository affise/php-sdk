<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

/**
* Class CountriesListDto
*/
class CountriesListDto
{
    private string $code;
    private string $name;

    public function __construct(array $attributes)
    {
        $this->code = $attributes['code'];
        $this->name = $attributes['name'];
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
