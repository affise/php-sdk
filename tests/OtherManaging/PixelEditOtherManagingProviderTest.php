<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class PixelEditOtherManagingProviderTest
 */
class PixelEditOtherManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => 2,
            'name' => 'test2',
            'code' => '<script>test2</script>',
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
     */
    public function testPixelEditShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/pixel/2', [])
            ->willReturn(
                [
                    'status' => 1,
                    'pixel' => static::$attributes,
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->pixelEdit(2, []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelEditWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'name' => 'Dr. Pearl Jacobs V',
            'code' => '<script>test</script>',
            'code_type' => 'javascript',
            'is_active' => 1,
            'moderation_status' => 1,
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/pixel/2', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->pixelEdit(2, $filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testPixelEditResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/pixel/2')
            ->willReturn(
                [
                    'status' => 1,
                    'pixel' => $attributes,
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $response = $otherManagingProvider->pixelEdit(2);

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
    public function testPixelEditFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $otherManagingProvider = new OtherManagingProvider($transport);

        $this->expectException($exceptionClass);

        $otherManagingProvider->pixelEdit(2);
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
