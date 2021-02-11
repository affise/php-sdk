<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ByPartnerPostbackDto
*/
class ByPartnerPostbackDto
{
    private string $id;

    /**
     * @var array<string, string>
     */
    private array $get;

    /**
     * @var array<string, string>
     */
    private array $post;

    /**
    * @var array<string, int>
    */
    private array $date;
    private int $pid;
    private string $leadId;
    private int $httpCode;
    private string $postbackUrl;
    private int $offerId;
    private ?string $jobId;
    private string $goal;
    private int $status;
    private float $payouts;
    private float $revenue;
    private int $currency;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['_id']['$id'];
        $this->get = $attributes['_get'] ?? [];
        $this->post = $attributes['_post'] ?? [];
        $this->date = $attributes['date'] ?? [];
        $this->pid = $attributes['pid'];
        $this->leadId = $attributes['lead_id'];
        $this->httpCode = $attributes['http_code'];
        $this->postbackUrl = $attributes['postback_url'];
        $this->offerId = $attributes['offer_id'];
        $this->jobId = $attributes['job_id'] ?? null;
        $this->goal = $attributes['goal'];
        $this->status = $attributes['status'];
        $this->payouts = $attributes['payouts'];
        $this->revenue = $attributes['revenue'];
        $this->currency = $attributes['currency'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array<string, string>
     */
    public function getGet(): array
    {
        return $this->get;
    }

    /**
     * @return array<string, string>
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
    * @return array<string, int>
    */
    public function getDate(): array
    {
        return $this->date;
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function getLeadId(): string
    {
        return $this->leadId;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function getPostbackUrl(): string
    {
        return $this->postbackUrl;
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getJobId(): ?string
    {
        return $this->jobId;
    }

    public function getGoal(): string
    {
        return $this->goal;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getPayouts(): float
    {
        return $this->payouts;
    }

    public function getRevenue(): float
    {
        return $this->revenue;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }
}
