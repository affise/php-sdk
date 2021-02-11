<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

/**
* Class TicketDto
*/
class TicketDto
{
    private string $id;
    private string $status;
    private string $type;
    private string $title;
    private string $description;
    private string $created;
    private ?string $updated;

    /**
    * @var array<mixed>
    */
    private array $attachments;

    /**
    * @var array<string, int>
    */
    private array $comments;
    private PartnerDto $partner;
    private OfferDto $offer;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->status = $attributes['status'];
        $this->type = $attributes['type'];
        $this->title = $attributes['title'];
        $this->description = $attributes['description'];
        $this->created = $attributes['created'];
        $this->updated = $attributes['updated'] ?? null;
        $this->attachments = $attributes['attachments'] ?? [];
        $this->comments = $attributes['comments'] ?? [];
        $this->partner = new PartnerDto($attributes['partner']);
        $this->offer = new OfferDto($attributes['offer']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    /**
    * @return array<mixed>
    */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
    * @return array<string, int>
    */
    public function getComments(): array
    {
        return $this->comments;
    }

    public function getPartner(): PartnerDto
    {
        return $this->partner;
    }

    public function getOffer(): OfferDto
    {
        return $this->offer;
    }
}
