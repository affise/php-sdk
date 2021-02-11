<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TransportException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class PsrTransport
 */
class PsrTransport extends AbstractTransport
{
    protected RequestFactoryInterface $requestFactory;
    protected UriFactoryInterface $uriFactory;
    protected StreamFactoryInterface $streamFactory;
    protected ClientInterface $client;

    /**
     * PsrTransport constructor.
     *
     * @param \Psr\Http\Message\RequestFactoryInterface $requestFactory
     * @param \Psr\Http\Message\UriFactoryInterface $uriFactory
     * @param \Psr\Http\Message\StreamFactoryInterface $streamFactory
     * @param \Psr\Http\Client\ClientInterface $client
     * @param string $baseUri
     * @param string $apiKey
     */
    public function __construct(
        RequestFactoryInterface $requestFactory,
        UriFactoryInterface $uriFactory,
        StreamFactoryInterface $streamFactory,
        ClientInterface $client,
        string $baseUri,
        string $apiKey
    ) {
        $this->requestFactory = $requestFactory;
        $this->uriFactory = $uriFactory;
        $this->streamFactory = $streamFactory;
        $this->client = $client;

        parent::__construct($baseUri, $apiKey);
    }

    /**
     * {@inheritDoc}
     */
    protected function createUri(string $baseUri): UriInterface
    {
        return $this->uriFactory->createUri($baseUri);
    }

    /**
     * {@inheritDoc}
     */
    protected function createRequest(string $method, UriInterface $uri): RequestInterface
    {
        return $this->requestFactory->createRequest($method, $uri);
    }

    /**
     * {@inheritDoc}
     */
    protected function createRequestBody(string $content): StreamInterface
    {
        return $this->streamFactory->createStream($content);
    }

    /**
     * {@inheritDoc}
     */
    protected function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->sendRequest($request);
        } catch (NetworkExceptionInterface $e) {
            throw new TimeoutException('Network issues detected for ' . $request->getUri()->getPath(), 0, $e);
        } catch (ClientExceptionInterface $e) {
            throw new TransportException('An error occurred while sending request to ' . $request->getUri()->getPath(), 0, $e);
        }
    }
}
