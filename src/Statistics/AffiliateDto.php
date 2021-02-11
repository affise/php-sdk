<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
 * Class AffiliateDto
 */
class AffiliateDto
{
    private int $id;
    private string $email;
    private string $login;
    private string $name;

    /**
     * AffiliateDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->email = $attributes['email'];
        $this->login = $attributes['login'];
        $this->name = $attributes['name'];
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
}
