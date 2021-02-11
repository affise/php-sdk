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
 * Class SmartlinkEditCategoryOtherManagingProviderTest
 */
class SmartlinkEditCategoryOtherManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            '_id' => '595fd4877e28fee8428b459f',
            'name' => 'test123',
            'domain' => 'ipsa',
            'description' => 'test',
            'created_at' => '2017-07-07 18:35:51',
            'updated_at' => '2017-07-07 18:35:51',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkEditCategoryShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/smartlink/category/e9df488b360a42fd82cfa6c87d830f4ec0d86d58', [])
            ->willReturn(
                [
                    'status' => 1,
                    'data' => static::$attributes,
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->smartLinkEditCategory('e9df488b360a42fd82cfa6c87d830f4ec0d86d58', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkEditCategoryWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'name' => 'Aaron Hayes',
            'domain_id' => 153334546,
            'description' => 'consequatur',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/smartlink/category/e9df488b360a42fd82cfa6c87d830f4ec0d86d58', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->smartLinkEditCategory('e9df488b360a42fd82cfa6c87d830f4ec0d86d58', $filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkEditCategoryResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/smartlink/category/e9df488b360a42fd82cfa6c87d830f4ec0d86d58')
            ->willReturn(
                [
                    'status' => 1,
                    'data' => $attributes,
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $response = $otherManagingProvider->smartLinkEditCategory('e9df488b360a42fd82cfa6c87d830f4ec0d86d58');

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(SmartLinkCategoryDto::class, $response->getData());
        $this->assertEquals(new SmartLinkCategoryDto($attributes), $response->getData());
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
    public function testSmartLinkEditCategoryFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $otherManagingProvider = new OtherManagingProvider($transport);

        $this->expectException($exceptionClass);

        $otherManagingProvider->smartLinkEditCategory('e9df488b360a42fd82cfa6c87d830f4ec0d86d58');
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
