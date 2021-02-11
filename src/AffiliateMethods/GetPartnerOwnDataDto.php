<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

/**
* Class GetPartnerOwnDataDto
*/
class GetPartnerOwnDataDto
{
    private int $partnerId;
    private string $id;
    private string $apiKey;
    private ?string $info;
    private string $createdAt;
    private ?string $settings;
    private string $email;
    private ?string $login;
    private ?string $name;
    private ?string $company;
    private string $status;
    private string $updatedAt;
    private ?string $confirmCode;
    private string $ref;
    private string $lang;
    private ?string $timezone;
    private ?string $level;
    private string $managerId;
    private string $notes;
    private string $refPercent;
    private ?string $paySys;
    private string $payAcc;
    private string $payAccWmz;
    private string $balanceRu;
    private string $holdRu;
    private string $availableRu;
    private string $balanceUsd;
    private string $holdUsd;
    private string $availableUsd;
    private string $address1;
    private ?string $address2;
    private string $city;
    private string $country;
    private ?string $zipCode;
    private ?string $phone;

    /**
    * @var array<array<string, mixed>>
    */
    private array $subAccounts;
    private string $tipaltiInfo;
    private string $contactPerson;
    private ?string $tags;
    private string $type;

    /**
    * @var array<string, mixed>
    */
    private array $permissions;
    private string $workHours;
    private string $lastLoginAt;

    public function __construct(array $attributes)
    {
        $this->partnerId = $attributes['partner_id'];
        $this->id = $attributes['id'];
        $this->apiKey = $attributes['api_key'];
        $this->info = $attributes['info'] ?? null;
        $this->createdAt = $attributes['created_at'];
        $this->settings = $attributes['settings'] ?? null;
        $this->email = $attributes['email'];
        $this->login = $attributes['login'] ?? null;
        $this->name = $attributes['name'] ?? null;
        $this->company = $attributes['company'] ?? null;
        $this->status = $attributes['status'];
        $this->updatedAt = $attributes['updated_at'];
        $this->confirmCode = $attributes['confirm_code'] ?? null;
        $this->ref = $attributes['ref'];
        $this->lang = $attributes['lang'];
        $this->timezone = $attributes['timezone'] ?? null;
        $this->level = $attributes['level'] ?? null;
        $this->managerId = $attributes['manager_id'];
        $this->notes = $attributes['notes'];
        $this->refPercent = $attributes['ref_percent'];
        $this->paySys = $attributes['pay_sys'] ?? null;
        $this->payAcc = $attributes['pay_acc'];
        $this->payAccWmz = $attributes['pay_acc_wmz'];
        $this->balanceRu = $attributes['balance_ru'];
        $this->holdRu = $attributes['hold_ru'];
        $this->availableRu = $attributes['available_ru'];
        $this->balanceUsd = $attributes['balance_usd'];
        $this->holdUsd = $attributes['hold_usd'];
        $this->availableUsd = $attributes['available_usd'];
        $this->address1 = $attributes['address_1'];
        $this->address2 = $attributes['address_2'] ?? null;
        $this->city = $attributes['city'];
        $this->country = $attributes['country'];
        $this->zipCode = $attributes['zip_code'] ?? null;
        $this->phone = $attributes['phone'] ?? null;
        $this->subAccounts = $attributes['sub_accounts'] ?? [];
        $this->tipaltiInfo = $attributes['tipalti_info'];
        $this->contactPerson = $attributes['contact_person'];
        $this->tags = $attributes['tags'] ?? null;
        $this->type = $attributes['type'];
        $this->permissions = $attributes['permissions'] ?? [];
        $this->workHours = $attributes['work_hours'];
        $this->lastLoginAt = $attributes['last_login_at'];
    }

    public function getPartnerId(): int
    {
        return $this->partnerId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getSettings(): ?string
    {
        return $this->settings;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getConfirmCode(): ?string
    {
        return $this->confirmCode;
    }

    public function getRef(): string
    {
        return $this->ref;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function getManagerId(): string
    {
        return $this->managerId;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getRefPercent(): string
    {
        return $this->refPercent;
    }

    public function getPaySys(): ?string
    {
        return $this->paySys;
    }

    public function getPayAcc(): string
    {
        return $this->payAcc;
    }

    public function getPayAccWmz(): string
    {
        return $this->payAccWmz;
    }

    public function getBalanceRu(): string
    {
        return $this->balanceRu;
    }

    public function getHoldRu(): string
    {
        return $this->holdRu;
    }

    public function getAvailableRu(): string
    {
        return $this->availableRu;
    }

    public function getBalanceUsd(): string
    {
        return $this->balanceUsd;
    }

    public function getHoldUsd(): string
    {
        return $this->holdUsd;
    }

    public function getAvailableUsd(): string
    {
        return $this->availableUsd;
    }

    public function getAddress1(): string
    {
        return $this->address1;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
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

    /**
    * @return array<array<string, mixed>>
    */
    public function getSubAccounts(): array
    {
        return $this->subAccounts;
    }

    public function getTipaltiInfo(): string
    {
        return $this->tipaltiInfo;
    }

    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
    * @return array<string, mixed>
    */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getWorkHours(): string
    {
        return $this->workHours;
    }

    public function getLastLoginAt(): string
    {
        return $this->lastLoginAt;
    }
}
