<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\OtherManaging\PixelDto;
use Affise\Sdk\Transport\TransportInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class PixelAddAffiliateMethodsProviderTest
 */
class PixelAddAffiliateMethodsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => 2,
            'name' => 'test',
            'code' => '<script>test</script>',
            'code_type' => 'javascript',
            'offer_id' => '906',
            'offer' => [
                'id' => 11,
                'offer_id' => '5f05f2f5134ed05c008b4568',
                'title' => 'Varmogvillig.com CPL DOI NO WEB\\TAB\\MOB',
                'preview_url' => 'https://www.varmogvillig.com/landing2',
            ],
            'pid' => '610',
            'is_active' => '0',
            'moderation_status' => '0',
            'created_at' => '2017-06-21 03:34:51',
            'updated_at' => '2017-06-21 03:34:51',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testPixelAddFailsWhenFiltersAreNotSet(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $affiliateMethodsProvider->pixelAdd([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelAddWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'offer_id' => 1018749969,
            'name' => 'Gay Lebsack III',
            'code' => '<script>test</scipt>',
            'code_type' => 'javascript',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/pixel', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $affiliateMethodsProvider->pixelAdd($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelAddFailsWhenOfferIdIsNotPassed(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'offer_id' is required");

        $affiliateMethodsProvider->pixelAdd(
            [
                'name' => 'Gay Lebsack III',
                'code' => '<script>test</scipt>',
                'code_type' => 'javascript',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelAddFailsWhenNameIsNotPassed(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'name' is required");

        $affiliateMethodsProvider->pixelAdd(
            [
                'offer_id' => 1018749969,
                'code' => '<script>test</scipt>',
                'code_type' => 'javascript',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelAddFailsWhenCodeIsNotPassed(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'code' is required");

        $affiliateMethodsProvider->pixelAdd(
            [
                'offer_id' => 1018749969,
                'name' => 'Gay Lebsack III',
                'code_type' => 'javascript',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelAddFailsWhenCodeTypeIsNotPassed(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'code_type' is required");

        $affiliateMethodsProvider->pixelAdd(
            [
                'offer_id' => 1018749969,
                'name' => 'Gay Lebsack III',
                'code' => '<script>test</scipt>',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelAddResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/pixel')
            ->willReturn(
                [
                    'status' => 1,
                    'pixel' => $attributes,
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $response = $affiliateMethodsProvider->pixelAdd(
            [
                'offer_id' => 1018749969,
                'name' => 'Gay Lebsack III',
                'code' => '<script>test</scipt>',
                'code_type' => 'javascript',
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(PixelDto::class, $response->getData());
        $this->assertEquals(new PixelDto($attributes), $response->getData());
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
    public function testPixelAddFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateMethodsProvider->pixelAdd(
            [
                'offer_id' => 1018749969,
                'name' => 'Gay Lebsack III',
                'code' => '<script>test</scipt>',
                'code_type' => 'javascript',
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
