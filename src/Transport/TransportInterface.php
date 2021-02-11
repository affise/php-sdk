<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

/**
 * Interface TransportInterface
 *
 * Base interface for transport layer.
 */
interface TransportInterface
{
    /**
     * Calls api endpoint using HTTP GET method.
     *
     * @param string $uri A path without host
     * @param array<string, mixed> $data A map of query params
     * @param array<string, string> $headers
     *
     * @return array<string, mixed> Api response as map
     *
     * @throws \Affise\Sdk\Exception\TransportException
     * @throws \InvalidArgumentException
     */
    public function get(string $uri, array $data = [], array $headers = []): array;

    /**
     * Calls api endpoint using HTTP POST method.
     *
     * @param string $uri A path without host
     * @param array<string, mixed> $data A map of request body
     * @param array<string, string> $headers
     *
     * @return array<string, mixed> Api response as map
     *
     * @throws \Affise\Sdk\Exception\TransportException
     * @throws \InvalidArgumentException
     */
    public function post(string $uri, array $data = [], array $headers = []): array;

    /**
     * Calls api endpoint using HTTP DELETE method.
     *
     * @param string $uri A path without host
     * @param array<string, mixed> $data A map of query params.
     * @param array<string, string> $headers
     *
     * @return array<string, mixed> Api response as map
     *
     * @throws \Affise\Sdk\Exception\TransportException
     * @throws \InvalidArgumentException
     */
    public function delete(string $uri, array $data = [], array $headers = []): array;
}
