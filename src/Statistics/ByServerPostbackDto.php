<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

/**
* Class ByServerPostbackDto
*/
class ByServerPostbackDto
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
    private string $server;
    private ?SupplierDto $supplier;

    /**
    * @var array<string, int>
    */
    private array $date;
    private string $response;
    private ?TrackDto $track;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['_id']['$id'];
        $this->get = $attributes['_get'] ?? [];
        $this->post = $attributes['_post'] ?? [];
        $this->server = $attributes['server'];
        $this->supplier = empty($attributes['supplier']) ? null : new SupplierDto($attributes['supplier']);
        $this->date = $attributes['date'] ?? [];
        $this->response = $attributes['response'];
        $this->track = empty($attributes['track']) ? null : new TrackDto($attributes['track']);
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

    public function getServer(): string
    {
        return $this->server;
    }

    public function getSupplier(): ?SupplierDto
    {
        return $this->supplier;
    }

    /**
    * @return array<string, int>
    */
    public function getDate(): array
    {
        return $this->date;
    }

    public function getResponse(): string
    {
        return $this->response;
    }

    public function getTrack(): ?TrackDto
    {
        return $this->track;
    }
}
