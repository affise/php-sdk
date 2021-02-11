<?php

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

/**
* Class ImportMultipleConversionsDto
*/
class ImportMultipleConversionsDto
{
    /**
    * @var array<\Affise\Sdk\ConversionsManaging\ConversionDto>
    */
    private array $list;

    public function __construct(array $attributes)
    {
        $this->list = array_map(fn(array $item) => new ConversionDto($item), $attributes['list'] ?? []);
    }

    /**
    * @return array<\Affise\Sdk\ConversionsManaging\ConversionDto>
    */
    public function getList(): array
    {
        return $this->list;
    }
}
