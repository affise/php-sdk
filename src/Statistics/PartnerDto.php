<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use Affise\Sdk\User\UserDto;

/**
* Class PartnerDto
*/
class PartnerDto
{
    private int $id;
    private string $email;
    private string $login;
    private string $name;
    private ?UserDto $manager;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->email = $attributes['email'];
        $this->login = $attributes['login'];
        $this->name = $attributes['name'];
        $this->manager = empty($attributes['manager']) ? null : new UserDto($attributes['manager']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getManager(): ?UserDto
    {
        return $this->manager;
    }
}
