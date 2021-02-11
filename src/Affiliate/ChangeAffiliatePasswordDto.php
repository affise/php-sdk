<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

/**
* Class ChangeAffiliatePasswordDto
*/
class ChangeAffiliatePasswordDto
{
    private int $id;
    private string $password;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->password = $attributes['password'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
