<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use Affise\Sdk\User\UserDto;

/**
* Class AffiliateDto
*/
class AffiliateDto
{
    private int $id;
    private string $createdAt;
    private string $updatedAt;
    private string $email;
    private string $login;
    private ?string $contactPerson;
    private ?string $refPercent;
    private ?string $name;
    private string $notes;
    private ?UserDto $manager;
    private string $status;
    private int $level;

    /**
    * @var array<\Affise\Sdk\Affiliate\PaymentSystemsDto>
    */
    private array $paymentSystems;

    /**
    * @var array<\Affise\Sdk\Affiliate\CustomFieldsDto>
    */
    private array $customFields;

    /**
    * @var array<string, array<string, int>>
    */
    private array $balance;
    private int $offersCount;
    private ?string $apiKey;
    private ?string $address1;
    private ?string $address2;
    private ?string $city;
    private ?string $country;
    private ?string $zipCode;
    private ?string $phone;
    private string $ref;

    /**
     * @var array<array<string, mixed>>
     */
    private array $subAccounts;

    /**
     * @var array<mixed>
     */
    private array $tags;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->createdAt = $attributes['created_at'];
        $this->updatedAt = $attributes['updated_at'];
        $this->email = $attributes['email'];
        $this->login = $attributes['login'];
        $this->contactPerson = $attributes['contactPerson'] ?? null;
        $this->refPercent = $attributes['ref_percent'] ?? null;
        $this->name = $attributes['name'] ?? null;
        $this->notes = $attributes['notes'];
        $this->manager = isset($attributes['manager']) ? new UserDto($attributes['manager']) : null;
        $this->status = $attributes['status'];
        $this->level = $attributes['level'];
        $this->paymentSystems = array_map(fn(array $item) => new PaymentSystemsDto($item), $attributes['payment_systems'] ?? []);
        $this->customFields = array_map(fn(array $item) => new CustomFieldsDto($item), $attributes['customFields'] ?? []);
        $this->balance = $attributes['balance'] ?? [];
        $this->offersCount = $attributes['offersCount'];
        $this->apiKey = $attributes['api_key'] ?? null;
        $this->address1 = $attributes['address_1'] ?? null;
        $this->address2 = $attributes['address_2'] ?? null;
        $this->city = $attributes['city'] ?? null;
        $this->country = $attributes['country'] ?? null;
        $this->zipCode = $attributes['zip_code'] ?? null;
        $this->phone = $attributes['phone'] ?? null;
        $this->ref = $attributes['ref'];
        $this->subAccounts = $attributes['sub_accounts'] ?? [];
        $this->tags = $attributes['tags'] ?? [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function getRefPercent(): ?string
    {
        return $this->refPercent;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getManager(): ?UserDto
    {
        return $this->manager;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    /**
    * @return array<\Affise\Sdk\Affiliate\PaymentSystemsDto>
    */
    public function getPaymentSystems(): array
    {
        return $this->paymentSystems;
    }

    /**
    * @return array<\Affise\Sdk\Affiliate\CustomFieldsDto>
    */
    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    /**
    * @return array<string, array<string, int>>
    */
    public function getBalance(): array
    {
        return $this->balance;
    }

    public function getOffersCount(): int
    {
        return $this->offersCount;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function getSubAccounts(): array
    {
        return $this->subAccounts;
    }

    /**
     * @return array<mixed>
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
