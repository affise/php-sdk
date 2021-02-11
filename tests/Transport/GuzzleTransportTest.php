<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\DuplicateEntityException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * Class GuzzleTransportTest
 */
class GuzzleTransportTest extends TestCase
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
        new GuzzleTransport('', static::API_KEY);
    }

    /**
     * @return void
     */
    public function testCreateTransportWithInvalidUri(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Base uri is not a hostname');
        new GuzzleTransport('test', static::API_KEY);
    }

    /**
     * @return void
     */
    public function testCreateTransportWithEmptyApiKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Api key cannot be empty');
        new GuzzleTransport(static::BASE_URI, '');
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
            ->method('send')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => (string) $request->getUri() === static::BASE_URI . $path),
                $this->anything()
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
            ->method('send')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getHeaderLine(GuzzleTransport::HEADER_API_KEY) === static::API_KEY),
                $this->anything()
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
            ->method('send')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(function (RequestInterface $request) {
                    return $request->getHeaderLine('User-Agent') === 'test'
                        && $request->getHeaderLine('Connection') === 'keep-alive'
                        && $request->getHeaderLine('X-Custom') === '1';
                }),
                $this->anything()
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
            ->method('send')
            ->willReturnCallback(fn() => new Response(200, [], '{}'))
            ->with(
                $this->callback(function (RequestInterface $request) {
                    return $request->getHeaderLine('User-Agent') === 'other'
                        && $request->getHeaderLine('Connection') === 'keep-alive'
                        && $request->getHeaderLine('X-Custom') === '1'
                        && $request->getHeaderLine('Content-Type') === 'application/x-www-form-urlencoded'
                        && $request->getHeaderLine('X-New') === '1';
                }),
                $this->anything()
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
        $client = new Client(['handler' => MockHandler::createWithMiddleware([$response])]);
        $transport = $this->createTransport($client);

        $this->assertEquals(['status' => 1, 'items' => [['id' => 1, 'name' => 'test']]], $transport->get('/test'));

        $response = new Response(200, ['Content-Type' => 'application/json'], '{}');
        $client = new Client(['handler' => MockHandler::createWithMiddleware([$response])]);
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
            ->method('send')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getUri()->getQuery() === http_build_query($queryParams)),
                $this->anything()
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
        $client = new Client(['handler' => MockHandler::createWithMiddleware([$response])]);
        $transport = $this->createTransport($client);

        $this->assertEquals(['status' => 1, 'items' => [['id' => 1, 'name' => 'test']]], $transport->post('/test'));

        $response = new Response(200, ['Content-Type' => 'application/json'], '{}');
        $client = new Client(['handler' => MockHandler::createWithMiddleware([$response])]);
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
            ->method('send')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getHeaderLine('Content-Type') === 'application/json'),
                $this->anything()
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
            ->method('send')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getBody()->getContents() === json_encode($data)),
                $this->anything()
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
            ->method('send')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getBody()->getContents() === http_build_query($data)),
                $this->anything()
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
            ->method('send')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getBody()->getContents() === $expected),
                $this->anything(),
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
        $client = new Client(['handler' => MockHandler::createWithMiddleware([$response])]);
        $transport = $this->createTransport($client);

        $this->assertEquals(['status' => 1, 'items' => [['id' => 1, 'name' => 'test']]], $transport->delete('/test'));

        $response = new Response(200, ['Content-Type' => 'application/json'], '{}');
        $client = new Client(['handler' => MockHandler::createWithMiddleware([$response])]);
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
            ->method('send')
            ->willReturn(new Response(200, [], '{}'))
            ->with(
                $this->callback(fn(RequestInterface $request) => $request->getUri()->getQuery() === http_build_query($queryParams)),
                $this->anything()
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
        $client = new Client(['handler' => MockHandler::createWithMiddleware([$response])]);
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
        $client = new Client([
             'handler' => MockHandler::createWithMiddleware([function () use ($path) {
                 throw new ConnectException('Could not connect to the target', new Request('GET', static::BASE_URI . $path));
             }]),
        ]);

        $transport = $this->createTransport($client);

        $this->expectException(TimeoutException::class);

        $transport->get($path);
    }

    /**
     * @param int $status
     * @param string|null $jsonResponse
     * @param class-string<\GuzzleHttp\Exception\BadResponseException> $guzzleExceptionClass
     * @param int $expectedCode
     * @param string $expectedMessage
     * @param class-string<TransportException> $expectedExceptionClass
     *
     * @return void
     *
     * @dataProvider guzzleErrorsProvider
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testErrorHandlerWhenGuzzleClientIsThrowsBadResponseException(
        int $status,
        ?string $jsonResponse,
        string $guzzleExceptionClass,
        int $expectedCode,
        string $expectedMessage,
        string $expectedExceptionClass
    ): void {
        $path = '/3.0/user/list';
        $request = new Request('GET', static::BASE_URI . $path);
        $response = new Response($status, ['Content-Type' => 'application/json'], $jsonResponse);

        $client = new Client([
             'handler' => MockHandler::createWithMiddleware([function () use ($response, $request, $guzzleExceptionClass) {
                 /** @psalm-suppress UnsafeInstantiation */
                 throw new $guzzleExceptionClass('Error', $request, $response);
             }]),
        ]);

        $transport = $this->createTransport($client);

        $this->expectException($expectedExceptionClass);
        $this->expectExceptionCode($expectedCode);
        $this->expectExceptionMessage($expectedMessage);

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
     * @return array<array<mixed>>
     */
    public function guzzleErrorsProvider(): array
    {
        return [
            [400, '{"status":2,"error":"Invalid url"}', ClientException::class, 2, 'Invalid url', BadRequestException::class],
            [401, '{"error":"Invalid token"}', ClientException::class, 0, 'Invalid token', TokenMissingException::class],
            [403, '{"status":2}', ClientException::class, 2, 'Auth Denied', AccessDeniedException::class],
            [404, '{}', ClientException::class, 0, 'Resource Not Found', EndpointNotFoundException::class],
            [409, '{}', ClientException::class, 0, 'Conflict', DuplicateEntityException::class],

            [405, '{"status":2,"error":"Invalid request method"}', ClientException::class, 2, 'Invalid request method', TransportException::class],
            [405, '{"error":"Invalid request method"}', ClientException::class, 0, 'Invalid request method', TransportException::class],
            [405, '{"status":2}', ClientException::class, 2, '405 Method Not Allowed', TransportException::class],
            [405, '{}', ClientException::class, 0, '405 Method Not Allowed', TransportException::class],

            [500, '{"status":2,"error":"Server error"}', ServerException::class, 2, 'Server error', TransportException::class],
            [500, '{"error":"Server error"}', ServerException::class, 0, 'Server error', TransportException::class],
            [502, '{"status":2}', ServerException::class, 2, '502 Bad Gateway', TransportException::class],
            [503, '{}', ServerException::class, 0, '503 Service Unavailable', TransportException::class],
        ];
    }

    /**
     * @param \GuzzleHttp\ClientInterface $client
     * @param string $baseUri
     * @param string $apiKey
     *
     * @return \Affise\Sdk\Transport\GuzzleTransport
     */
    protected function createTransport(ClientInterface $client, string $baseUri = self::BASE_URI, string $apiKey = self::API_KEY): GuzzleTransport
    {
        return new GuzzleTransport($baseUri, $apiKey, $client);
    }
}
