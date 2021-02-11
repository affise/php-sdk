<?php

declare(strict_types=1);

namespace Affise\Sdk\Helper;

use Affise\Sdk\Transport\TransportInterface;

/**
 * Class AbstractProvider
 */
abstract class AbstractProvider
{
    protected TransportInterface $transport;

    /**
     * AbstractProvider constructor.
     *
     * @param \Affise\Sdk\Transport\TransportInterface $transport
     */
    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }
}
