<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class SourceAddOfferManagingProviderTest
 */
class SourceAddOfferManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'title' => 'api-test-en-3',
            'title_lang' => [
                'en' => 'api-test-en-3',
                'ru' => 'api-test-ru-3',
                'es' => 'api-test-es-2',
                'ka' => 'api-test-ka-2',
                'vi' => 'api-test-vi-3',
            ],
            'id' => '5b7e6d350f0e5a001c7bb4d5',

        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testSourceAddFailsWhenFiltersAreNotSet(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $offerManagingProvider->sourceAdd([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSourceAddWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'title_lang' => ['en' => 'aut'],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer/source', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->sourceAdd($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testSourceAddFailsWhenTitleLangIsNotPassed(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'title_lang' is required");

        $offerManagingProvider->sourceAdd([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSourceAddContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'title_lang' => ['en' => 'aut'],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer/source', $data, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->sourceAdd($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSourceAddResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/offer/source')
            ->willReturn(
                [
                    'status' => 1,
                    'source' => $attributes,
                ]
            );

        $offerManagingProvider = new OfferManagingProvider($transport);
        $response = $offerManagingProvider->sourceAdd(
            [
                'title_lang' => ['en' => 'aut'],
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(SourceAddDto::class, $response->getData());
        $this->assertEquals(new SourceAddDto($attributes), $response->getData());
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
    public function testSourceAddFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $offerManagingProvider = new OfferManagingProvider($transport);

        $this->expectException($exceptionClass);

        $offerManagingProvider->sourceAdd(
            [
                'title_lang' => ['en' => 'aut'],
            ]
        );
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
