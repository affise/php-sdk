<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\DuplicateEntityException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Response;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Http\Factory\Guzzle\UriFactory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class PsrTransportTest
 */
class PsrTransportTest extends TestCase
{
    const BASE_URI = 'http://example.com';
    const API_KEY = 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4';

    /**
     * @return void
     */
    public function testCreateTransportWithEmptyBaseUri(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Base uri cannot be empty');
        new PsrTransport(new RequestFactory(), new UriFactory(), new StreamFactory(), $this->createPsrClientStub(), '', static::API_KEY);
    }

    /**
     * @return void
     */
    public function testCreateTransportWithInvalidUri(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Base uri is not a hostname');
        new PsrTransport(new RequestFactory(), new UriFactory(), new StreamFactory(), $this->createPsrClientStub(), 'test', static::API_KEY);
    }

    /**
     * @return void
     */
    public function testCreateTransportWithEmptyApiKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Api key cannot be empty');
        new PsrTransport(new RequestFactory(), new UriFactory(), new StreamFactory(), $this->createPsrClientStub(), static::BASE_URI, '');
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testBaseUriIsSetToClient(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $path = '/3.0/user/list';

        $client->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => (string) $request->getUri() === static::BASE_URI . $path),
            );

        $transport = $this->createTransport($client);
        $transport->get($path);
        $transport->post($path);
        $transport->delete($path);
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testApiKeyIsSetToClient(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $path = '/3.0/user/list';

        $client->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getHeaderLine(GuzzleTransport::HEADER_API_KEY) === static::API_KEY),
            );

        $transport = $this->createTransport($client);
        $transport->get($path);
        $transport->post($path);
        $transport->delete($path);
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSetHeaders(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(function (RequestInterface $request) {
                    return $request->getHeaderLine('User-Agent') === 'test'
                        && $request->getHeaderLine('Connection') === 'keep-alive'
                        && $request->getHeaderLine('X-Custom') === '1';
                }),
            );

        $transport = $this->createTransport($client);
        $transport->setHeaders(['User-Agent' => 'test', 'Connection' => 'keep-alive', 'X-Custom' => 1]);

        $transport->get('/3.0/user/list');
        $transport->post('/3.0/user/list');
        $transport->delete('/3.0/user/list');
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testOverrideHeaders(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(function (RequestInterface $request) {
                    return $request->getHeaderLine('User-Agent') === 'other'
                        && $request->getHeaderLine('Connection') === 'keep-alive'
                        && $request->getHeaderLine('X-Custom') === '1'
                        && $request->getHeaderLine('Content-Type') === 'application/x-www-form-urlencoded'
                        && $request->getHeaderLine('X-New') === '1';
                }),
            );

        $transport = $this->createTransport($client);
        $transport->setHeaders(['User-Agent' => 'test', 'Connection' => 'keep-alive', 'X-Custom' => 1]);

        $transport->get('/3.0/user/list', [], ['User-Agent' => 'other', 'Content-Type' => 'application/x-www-form-urlencoded', 'X-New' => '1']);
        $transport->post('/3.0/user/list', [], ['User-Agent' => 'other', 'Content-Type' => 'application/x-www-form-urlencoded', 'X-New' => '1']);
        $transport->delete('/3.0/user/list', [], ['User-Agent' => 'other', 'Content-Type' => 'application/x-www-form-urlencoded', 'X-New' => '1']);
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGet(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json'], '{"status":1,"items":[{"id":1,"name":"test"}]}');
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        $transport = $this->createTransport($client);

        $this->assertEquals(['status' => 1, 'items' => [['id' => 1, 'name' => 'test']]], $transport->get('/test'));

        $response = new Response(200, ['Content-Type' => 'application/json'], '{}');
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        $transport = $this->createTransport($client);

        $this->assertEmpty($transport->get('/test'));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetWithQueryParams(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $queryParams = ['a' => 20, 'b' => 'test', 'c' => ['a', 'b', 15]];

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getUri()->getQuery() === http_build_query($queryParams)),
            );

        $transport = $this->createTransport($client);
        $this->assertEmpty($transport->get('/3.0/user/list', $queryParams));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPost(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json'], '{"status":1,"items":[{"id":1,"name":"test"}]}');
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        $transport = $this->createTransport($client);

        $this->assertEquals(['status' => 1, 'items' => [['id' => 1, 'name' => 'test']]], $transport->post('/test'));

        $response = new Response(200, ['Content-Type' => 'application/json'], '{}');
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        $transport = $this->createTransport($client);

        $this->assertEmpty($transport->post('/test'));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testContentTypeIsSetOnPostRequest(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getHeaderLine('Content-Type') === 'application/json'),
            );

        $transport = $this->createTransport($client);
        $this->assertEmpty($transport->post('/3.0/user/list'));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPostWithJsonRequestBody(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $data = ['a' => 20, 'b' => 'test', 'c' => ['a', 'b', 15]];

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getBody()->getContents() === json_encode($data)),
            );

        $transport = $this->createTransport($client);
        $this->assertEmpty($transport->post('/3.0/user/list', $data));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPostWithUrlEncodedRequestBody(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $data = ['a' => 20, 'b' => 'test', 'c' => ['a', 'b', 15]];

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getBody()->getContents() === http_build_query($data)),
            );

        $transport = $this->createTransport($client);
        $this->assertEmpty($transport->post('/3.0/user/list', $data, ['Content-Type' => 'application/x-www-form-urlencoded']));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPostWithMultipartRequestBody(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $data = ['a' => 20, 'b' => 'test', 'c' => ['a', 'b', 15], 'd' => File::createFromFile(__DIR__ . '/test.txt')];
        $expectedData = ['a' => 20, 'b' => 'test', 'c' => ['a', 'b', 15], 'd' => File::createFromFile(__DIR__ . '/test.txt')];
        $boundary = 'boundary---600957f408ff2';
        $headers = ['Content-Type' => 'multipart/form-data; boundary=' . $boundary];

        $stream = new MultipartStream(GuzzleMultipartUtils::convertData($expectedData), $boundary);
        $expected = $stream->getContents();

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getBody()->getContents() === $expected),
            );

        $transport = $this->createTransport($client);
        $this->assertEmpty($transport->post('/3.0/user/list', $data, $headers));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDelete(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json'], '{"status":1,"items":[{"id":1,"name":"test"}]}');
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        $transport = $this->createTransport($client);

        $this->assertEquals(['status' => 1, 'items' => [['id' => 1, 'name' => 'test']]], $transport->delete('/test'));

        $response = new Response(200, ['Content-Type' => 'application/json'], '{}');
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        $transport = $this->createTransport($client);

        $this->assertEmpty($transport->delete('/test'));
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDeleteWithQueryParams(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $queryParams = ['a' => 20, 'b' => 'test', 'c' => ['a', 'b', 15]];

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getUri()->getQuery() === http_build_query($queryParams)),
            );

        $transport = $this->createTransport($client);
        $this->assertEmpty($transport->delete('/3.0/user/list', $queryParams));
    }

    /**
     * @param int $httpStatus
     * @param string|null $jsonResponse
     * @param int $exceptionCode
     * @param string $exceptionMessage
     * @param class-string<TransportException> $exceptionClass
     *
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @dataProvider httpErrorsProvider
     */
    public function testHttpErrors(
        int $httpStatus,
        ?string $jsonResponse,
        int $exceptionCode,
        string $exceptionMessage,
        string $exceptionClass
    ): void {
        $response = new Response($httpStatus, ['Content-Type' => 'application/json'], $jsonResponse);
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        $transport = $this->createTransport($client);

        $this->expectException($exceptionClass);
        $this->expectExceptionCode($exceptionCode);
        $this->expectErrorMessage($exceptionMessage);

        $transport->get('/3.0/user/list');
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNetworkIssueException(): void
    {
        $path = '/3.0/user/list';
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturnCallback(function ($request) {
            $exception = $this->createStub(NetworkExceptionInterface::class);
            $exception->method('getRequest')->willReturn($request);

            throw $exception;
        });

        $transport = $this->createTransport($client);

        $this->expectException(TimeoutException::class);

        $transport->get($path);
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testHandlePsrRequestException(): void
    {
        $path = '/3.0/user/list';
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturnCallback(function ($request) {
            $exception = $this->createStub(RequestExceptionInterface::class);
            $exception->method('getRequest')->willReturn($request);

            throw $exception;
        });

        $transport = $this->createTransport($client);

        $this->expectException(TransportException::class);

        $transport->get($path);
    }

    /**
     * @return void
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testHandlePsrClientException(): void
    {
        $path = '/3.0/user/list';
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturnCallback(function () {
            throw $this->createStub(ClientExceptionInterface::class);
        });

        $transport = $this->createTransport($client);

        $this->expectException(TransportException::class);

        $transport->get($path);
    }

    /**
     * @return array<array<mixed>>
     */
    public function httpErrorsProvider(): array
    {
        return [
            [400, '{"status":2,"error":"Invalid url"}', 2, 'Invalid url', BadRequestException::class],
            [400, '{"error":"Invalid url"}', 0, 'Invalid url', BadRequestException::class],
            [400, '{"status":2}', 2, 'Bad Request', BadRequestException::class],
            [400, '{}', 0, 'Bad Request', BadRequestException::class],

            [401, '{"status":2,"error":"Invalid token"}', 2, 'Invalid token', TokenMissingException::class],
            [401, '{"error":"Invalid token"}', 0, 'Invalid token', TokenMissingException::class],
            [401, '{"status":2}', 2, 'Token is necessary', TokenMissingException::class],
            [401, '{}', 0, 'Token is necessary', TokenMissingException::class],

            [403, '{"status":2,"error":"Access denied"}', 2, 'Access denied', AccessDeniedException::class],
            [403, '{"error":"Access denied"}', 0, 'Access denied', AccessDeniedException::class],
            [403, '{"status":2}', 2, 'Auth Denied', AccessDeniedException::class],
            [403, '{}', 0, 'Auth Denied', AccessDeniedException::class],

            [404, '{"status":2,"error":"Not found"}', 2, 'Not found', EndpointNotFoundException::class],
            [404, '{"error":"Not found"}', 0, 'Not found', EndpointNotFoundException::class],
            [404, '{"status":2}', 2, 'Resource Not Found', EndpointNotFoundException::class],
            [404, '{}', 0, 'Resource Not Found', EndpointNotFoundException::class],

            [405, '{"status":2,"error":"Invalid request method"}', 2, 'Invalid request method', TransportException::class],
            [405, '{"error":"Invalid request method"}', 0, 'Invalid request method', TransportException::class],
            [405, '{"status":2}', 2, '405 Method Not Allowed', TransportException::class],
            [405, '{}', 0, '405 Method Not Allowed', TransportException::class],

            [409, '{"status":2,"error":"Duplicate entity"}', 2, 'Duplicate entity', DuplicateEntityException::class],
            [409, '{"error":"Duplicate entity"}', 0, 'Duplicate entity', DuplicateEntityException::class],
            [409, '{"status":2}', 2, 'Conflict', DuplicateEntityException::class],
            [409, '{}', 0, 'Conflict', DuplicateEntityException::class],

            [500, '{"status":2,"error":"Server error"}', 2, 'Server error', TransportException::class],
            [500, '{"error":"Server error"}', 0, 'Server error', TransportException::class],
            [500, '{"status":2}', 2, '500 Internal Server Error', TransportException::class],
            [500, '{}', 0, '500 Internal Server Error', TransportException::class],
        ];
    }

    /**
     * @param \Psr\Http\Client\ClientInterface $client
     * @param string $baseUri
     * @param string $apiKey
     *
     * @return \Affise\Sdk\Transport\PsrTransport
     */
    protected function createTransport(ClientInterface $client, string $baseUri = self::BASE_URI, string $apiKey = self::API_KEY): PsrTransport
    {
        return new PsrTransport(new RequestFactory(), new UriFactory(), new StreamFactory(), $client, $baseUri, $apiKey);
    }

    /**
     * @return \Psr\Http\Client\ClientInterface
     */
    protected function createPsrClientStub(): ClientInterface
    {
        return $this->createStub(ClientInterface::class);
    }
}
