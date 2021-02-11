<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\DuplicateEntityException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use GuzzleHttp\Psr7\Header;
use GuzzleHttp\Psr7\MultipartStream;
use InvalidArgumentException;
use JsonException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class AbstractTransport
 */
abstract class AbstractTransport implements TransportInterface
{
    public const HEADER_API_KEY = 'Api-Key';
    protected const METHOD_GET = 'GET';
    protected const METHOD_POST = 'POST';
    protected const METHOD_DELETE = 'DELETE';

    protected UriInterface $baseUri;
    protected string $apiKey;

    /**
     * Headers to be send.
     *
     * @var array<string, string>
     */
    protected array $headers = [
        'Accept' => 'application/json',
        'User-Agent' => 'affise/php-sdk-client',
    ];

    /**
     * AbstractTransport constructor.
     *
     * @param string $baseUri Api's base uri.
     * @param string $apiKey Api's auth key.
     *
     * @throws \InvalidArgumentException If base uri or apiKey is empty
     */
    public function __construct(string $baseUri, string $apiKey)
    {
        if (!$baseUri) {
            throw new InvalidArgumentException('Base uri cannot be empty');
        }

        if (!parse_url($baseUri, PHP_URL_HOST)) {
            throw new InvalidArgumentException('Base uri is not a hostname');
        }

        if (!$apiKey) {
            throw new InvalidArgumentException('Api key cannot be empty');
        }

        $this->baseUri = $this->createUri($baseUri);
        $this->apiKey = $apiKey;
    }

    /**
     * Sets HTTP headers. This method overrides previously headers.
     *
     * @param array<string, string> $headers
     *
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $uri, array $data = [], array $headers = []): array
    {
        $uri = $this->baseUri->withPath($uri)->withQuery(http_build_query($data));

        return $this->call(self::METHOD_GET, $uri, [], $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function post(string $uri, array $data = [], array $headers = []): array
    {
        $headers = array_merge(['Content-Type' => 'application/json'], $headers);

        return $this->call(self::METHOD_POST, $uri, $data, $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $uri, array $data = [], array $headers = []): array
    {
        $uri = $this->baseUri->withPath($uri)->withQuery(http_build_query($data));

        return $this->call(self::METHOD_DELETE, $uri, [], $headers);
    }

    /**
     * Creates an instance of @link{\Psr\Http\Message\UriInterface}.
     *
     * @param string $baseUri Api's base uri
     *
     * @return \Psr\Http\Message\UriInterface
     */
    abstract protected function createUri(string $baseUri): UriInterface;

    /**
     * Sends request to the api endpoint.
     *
     * @param string $method A HTTP method.
     * @param string|UriInterface $uri A path of api endpoint.
     * @param array<string, mixed> $body Request body.
     * @param array<string, mixed> $headers Request headers.
     *
     * @return array<string, mixed> Response data from api endpoint.
     *
     * @throws \Affise\Sdk\Exception\TransportException
     * @throws \InvalidArgumentException
     */
    protected function call(string $method, $uri, array $body = [], array $headers = []): array
    {
        if (is_string($uri)) {
            $uri = $this->baseUri->withPath($uri);
        }

        $request = $this->createRequest($method, $uri);
        $request = $this->mergeHeaders($request, $headers);

        if ($body) {
            [$additionalHeaders, $stream] = $this->serializeBody($request->getHeaderLine('Content-Type'), $body);

            $request = $this->assignHeaders($request, $additionalHeaders);
            $request = $request->withBody($stream);
        }

        $response = $this->sendRequest($request);

        return $this->handleResponse($response);
    }

    /**
     * Creates an instance of @link{\Psr\Http\Message\RequestInterface} as request.
     *
     * @param string $method A HTTP method.
     * @param \Psr\Http\Message\UriInterface $uri An api endpoint uri
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    abstract protected function createRequest(string $method, UriInterface $uri): RequestInterface;

    /**
     * Creates an instance of @link{\Psr\Http\Message\StreamInterface} as stream of request body.
     *
     * @param string $content
     *
     * @return \Psr\Http\Message\StreamInterface
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    abstract protected function createRequestBody(string $content): StreamInterface;

    /**
     * Sends a request to the api's endpoint.
     *
     * @param \Psr\Http\Message\RequestInterface $request Current request to be sent.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    abstract protected function sendRequest(RequestInterface $request): ResponseInterface;

    /**
     * Adds the necessary headers to the request.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array<string, string> $headers
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function mergeHeaders(RequestInterface $request, array $headers = []): RequestInterface
    {
        $request = $this->assignHeaders($request, array_merge($this->headers, $headers));

        return $request->withHeader(static::HEADER_API_KEY, $this->apiKey);
    }

    /**
     * Assigns any headers to the request.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array<string, string> $headers
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function assignHeaders(RequestInterface $request, array $headers): RequestInterface
    {
        foreach ($headers as $name => $header) {
            $request = $request->withHeader($name, $header);
        }

        return $request;
    }

    /**
     * Parses response data as JSON.
     *
     * @param \Psr\Http\Message\StreamInterface $stream
     *
     * @return array<string, mixed>
     *
     * @throws \Affise\Sdk\Exception\TransportException If response has invalid JSON
     */
    protected function parseResponseBody(StreamInterface $stream): array
    {
        try {
            return json_decode($stream->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new TransportException('Invalid json returned', 0, $e);
        }
    }

    /**
     * Handles any http responses.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<string, mixed>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    protected function handleResponse(ResponseInterface $response): array
    {
        $status = $response->getStatusCode();

        if ($status >= 200 && $status < 300) {
            return $this->parseResponseBody($response->getBody());
        }

        if ($status >= 300 && $status < 400) {
            throw new TransportException('Got a redirect response');
        }

        if ($status >= 400 && $status < 500) {
            return $this->handleClientErrors($response);
        }

        return $this->handleServerErrors($response);
    }

    /**
     * Handles client 4xx http errors.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<string, mixed>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidReturnType
     */
    protected function handleClientErrors(ResponseInterface $response): array
    {
        $data = $this->parseResponseBody($response->getBody());

        switch ($response->getStatusCode()) {
            case 400:
                throw new BadRequestException($data['error'] ?? 'Bad Request', $data['status'] ?? 0);
            case 401:
                throw new TokenMissingException($data['error'] ?? 'Token is necessary', $data['status'] ?? 0);
            case 403:
                throw new AccessDeniedException($data['error'] ?? 'Auth Denied', $data['status'] ?? 0);
            case 404:
                throw new EndpointNotFoundException($data['error'] ?? 'Resource Not Found', $data['status'] ?? 0);
            case 409:
                throw new DuplicateEntityException($data['error'] ?? 'Conflict', $data['status'] ?? 0);
            default:
                throw new TransportException($data['error'] ?? $response->getStatusCode() . ' ' . $response->getReasonPhrase(), $data['status'] ?? 0);
        }
    }

    /**
     * Handles server 5xx http errors.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<string, mixed>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    protected function handleServerErrors(ResponseInterface $response): array
    {
        try {
            $data = $this->parseResponseBody($response->getBody());
            $error = $data['error'] ?? $response->getStatusCode() . ' ' . $response->getReasonPhrase();
            $status = $data['status'] ?? 0;
        } catch (TransportException $e) {
            $error = $response->getStatusCode() . ' ' . $response->getReasonPhrase();
            $status = 0;
            // do nothing with $e
        }

        throw new TransportException($error, $status);
    }

    /**
     * Serializes request body to JSON.
     *
     * @param string $contentType
     * @param array<string, mixed> $data
     *
     * @return array<mixed> First value is an additional HTTP headers and second an instance of @link{\Psr\Http\Message\StreamInterface}.
     * @psalm-return array{0: array<string, string>, 1: \Psr\Http\Message\StreamInterface}
     *
     * @throws \Affise\Sdk\Exception\TransportException If serialization is failed
     */
    protected function serializeBody(string $contentType, array $data): array
    {
        $parsed = Header::parse($contentType)[0];

        $contentType = $parsed[0];
        $boundary = $parsed['boundary'] ?? null;

        if (strpos($contentType, 'json') !== false) {
            return [[], $this->createRequestBody($this->serializeBodyToJson($data))];
        }

        if ($contentType === 'application/x-www-form-urlencoded') {
            return [[], $this->createRequestBody($this->serializeToUrlEncoded($data))];
        }

        if ($contentType === 'multipart/form-data') {
            [$boundary, $stream] = $this->serializeToMultipartStream($data, $boundary);

            return [['Content-Type' => 'multipart/form-data; boundary=' . $boundary], $stream];
        }

        throw new TransportException('Unsupported content type ' . $contentType);
    }

    /**
     * Serializes request body to JSON.
     *
     * @param array<string, mixed> $data
     *
     * @return string
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    protected function serializeBodyToJson(array $data): string
    {
        try {
            return json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new TransportException('Invalid request body given', 0, $e);
        }
    }

    /**
     * Serializes request body to url-encoded format.
     *
     * @param array<string, mixed> $data
     *
     * @return string
     *
     * @throws \Affise\Sdk\Exception\TransportException If unable to serialize.
     */
    protected function serializeToUrlEncoded(array $data): string
    {
        return http_build_query($data);
    }

    /**
     * Serializes request body as a stream to multipart form-data format.
     *
     * @param array<string, mixed> $data
     * @param string|null $boundary
     *
     * @return array<mixed> First value is the content type's boundary and second an instance of @link{\Psr\Http\Message\StreamInterface}.
     * @psalm-return array{0: string, 1: \Psr\Http\Message\StreamInterface}
     *
     * @throws \Affise\Sdk\Exception\TransportException If unable to serialize.
     */
    protected function serializeToMultipartStream(array $data, ?string $boundary = null): array
    {
        $items = GuzzleMultipartUtils::convertData($data);
        $stream = new MultipartStream($items, $boundary);

        return [$stream->getBoundary(), $stream];
    }
}
