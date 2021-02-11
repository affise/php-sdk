<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class AffiliateManagerDto
*/
class AffiliateManagerDto
{
    private string $id;
    private string $title;
    private string $firstName;
    private string $lastName;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->firstName = $attributes['first_name'];
        $this->lastName = $attributes['last_name'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
