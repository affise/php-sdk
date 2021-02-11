<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class NewsGetByIDAffiliateMethodsProviderTest
 */
class NewsGetByIDAffiliateMethodsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            '_id' => ['$id' => '57a4914f3b7d9bbd358b45b6'],
            'title' => 'Dr.',
            'small_desc' => 'occaecati',
            'desc' => 'molestiae',
            'status' => 1,
            'created_at' => ['sec' => 1470402895, 'usec' => 891000],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNewsGetByIDResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/news/1a04d0e45284c1d9324e104837f7c8ce4abdfe32')
            ->willReturn(
                [
                    'status' => 1,
                    'news' => $attributes,
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $response = $affiliateMethodsProvider->newsGetById('1a04d0e45284c1d9324e104837f7c8ce4abdfe32');

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(NewsDto::class, $response->getData());
        $this->assertEquals(new NewsDto($attributes), $response->getData());
    }

    /**
     * @param string $exceptionClass
     *
     * @psalm-param class-string<\Affise\Sdk\Exception\TransportException> $exceptionClass
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @dataProvider exceptionsProvider
     *
     * @psalm-suppress UnsafeInstantiation
     */
    public function testNewsGetByIDFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateMethodsProvider->newsGetById('1a04d0e45284c1d9324e104837f7c8ce4abdfe32');
    }

    /**
     * @return array<array<string>>
     * @psalm-return array<array<class-string<\Affise\Sdk\Exception\TransportException>>>
     */
    public function exceptionsProvider(): array
    {
        return [
            [AccessDeniedException::class],
            [BadRequestException::class],
            [EndpointNotFoundException::class],
            [TimeoutException::class],
            [TokenMissingException::class],
            [TransportException::class],
        ];
    }
}
