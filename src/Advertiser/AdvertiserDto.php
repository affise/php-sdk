<?php

declare(strict_types=1);

namespace Affise\Sdk\Advertiser;

use Affise\Sdk\User\UserDto;

/**
* Class AdvertiserDto
*/
class AdvertiserDto
{
    private string $id;
    private string $title;
    private ?string $contact;
    private ?string $email;
    private ?string $url;
    private string $manager;
    private ?UserDto $managerObj;

    /**
    * @var array<string>
    */
    private array $allowedIp;

    /**
    * @var array<string>
    */
    private array $disallowedIp;
    private ?string $skype;
    private ?string $note;
    private ?string $address1;
    private ?string $address2;
    private ?string $city;
    private ?string $country;
    private ?string $zipCode;
    private ?string $vatCode;

    /**
    * @var array<array<string, mixed>>
    */
    private array $subAccounts;
    private string $updatedAt;
    private bool $considerPersonalTargetingOnly;

    /**
     * @var array<string>
     */
    private array $tags;
    private bool $hostsOnly;
    private ?string $hashPassword;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->contact = $attributes['contact'] ?? null;
        $this->email = $attributes['email'] ?? null;
        $this->url = $attributes['url'] ?? null;
        $this->manager = $attributes['manager'];
        $this->managerObj = empty($attributes['manager_obj']) ? null : new UserDto($attributes['manager_obj']);
        $this->allowedIp = $attributes['allowed_ip'] ?? [];
        $this->disallowedIp = $attributes['disallowed_ip'] ?? [];
        $this->skype = $attributes['skype'] ?? null;
        $this->note = $attributes['note'] ?? null;
        $this->address1 = $attributes['address_1'] ?? null;
        $this->address2 = $attributes['address_2'] ?? null;
        $this->city = $attributes['city'] ?? null;
        $this->country = $attributes['country'] ?? null;
        $this->zipCode = $attributes['zip_code'] ?? null;
        $this->vatCode = $attributes['vat_code'] ?? null;
        $this->subAccounts = $attributes['sub_accounts'] ?? [];
        $this->updatedAt = $attributes['updated_at'];
        $this->considerPersonalTargetingOnly = $attributes['consider_personal_targeting_only'];
        $this->tags = $attributes['tags'] ?? [];
        $this->hostsOnly = $attributes['hosts_only'];
        $this->hashPassword = $attributes['hash_password'] ?? null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getManager(): string
    {
        return $this->manager;
    }

    public function getManagerObj(): ?UserDto
    {
        return $this->managerObj;
    }

    /**
    * @return array<string>
    */
    public function getAllowedIp(): array
    {
        return $this->allowedIp;
    }

    /**
    * @return array<string>
    */
    public function getDisallowedIp(): array
    {
        return $this->disallowedIp;
    }

    public function getSkype(): ?string
    {
        return $this->skype;
    }

    public function getNote(): ?string
    {
        return $this->note;
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

    public function getVatCode(): ?string
    {
        return $this->vatCode;
    }

    /**
    * @return array<array<string, mixed>>
    */
    public function getSubAccounts(): array
    {
        return $this->subAccounts;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getConsiderPersonalTargetingOnly(): bool
    {
        return $this->considerPersonalTargetingOnly;
    }

    /**
     * @return array<string>
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function getHostsOnly(): bool
    {
        return $this->hostsOnly;
    }

    public function getHashPassword(): ?string
    {
        return $this->hashPassword;
    }
}
