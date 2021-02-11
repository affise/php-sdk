<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TransportException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class GuzzleTransport
 */
class GuzzleTransport extends AbstractTransport
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected ClientInterface $client;

    /**
     * GuzzleTransport constructor.
     *
     * @param string $baseUri
     * @param string $apiKey
     * @param \GuzzleHttp\ClientInterface|null $client
     */
    public function __construct(string $baseUri, string $apiKey, ClientInterface $client = null)
    {
        parent::__construct($baseUri, $apiKey);

        $this->client = $client ?? new Client();
    }

    /**
     * {@inheritDoc}
     */
    protected function createUri(string $baseUri): UriInterface
    {
        return new Uri($baseUri);
    }

    /**
     * {@inheritDoc}
     */
    protected function createRequest(string $method, UriInterface $uri): RequestInterface
    {
        return new Request($method, $uri);
    }

    /**
     * {@inheritDoc}
     */
    protected function createRequestBody(string $content): StreamInterface
    {
        return Utils::streamFor($content);
    }

    /**
     * {@inheritDoc}
     */
    protected function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->send($request, [RequestOptions::HTTP_ERRORS => false]);
        } catch (ConnectException $e) {
            throw new TimeoutException('Could not connect to ' . $request->getUri()->getPath(), 0, $e);
        } catch (BadResponseException $e) {
            return $e->getResponse();
        } catch (GuzzleException $e) {
            throw new TransportException('An error occurred while sending request to ' . $request->getUri()->getPath(), 0, $e);
        }
    }
}
