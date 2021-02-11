<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
 * Class PostbackPartnerDto
 */
class PostbackPartnerDto
{
    private int $id;
    private string $email;
    private string $login;
    private ?string $name;
    private ?string $title;
    private ?AffiliateManagerDto $manager;
    private string $managerId;

    /**
     * PostbackPartnerDto constructor.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->email = $attributes['email'];
        $this->login = $attributes['login'];
        $this->name = $attributes['name'] ?? null;
        $this->title = $attributes['title'] ?? null;
        $this->manager = empty($attributes['manager']) ? null : new AffiliateManagerDto($attributes['manager']);
        $this->managerId = $attributes['manager_id'];
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getManager(): ?AffiliateManagerDto
    {
        return $this->manager;
    }

    public function getManagerId(): string
    {
        return $this->managerId;
    }
}
