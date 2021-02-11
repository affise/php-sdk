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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class SmartLinkAddCategoryOtherManagingProviderTest
 */
class SmartLinkAddCategoryOtherManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            '_id' => '595fd4877e28fee8428b459f',
            'name' => 'test',
            'domain' => 'a',
            'description' => 'test',
            'created_at' => '2017-07-07 18:35:51',
            'updated_at' => '2017-07-07 18:35:51',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testSmartLinkCategoryFailsWhenFiltersAreNotSet(): void
    {
        $otherManagingProvider = new OtherManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $otherManagingProvider->smartLinkAddCategory([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkCategoryWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'name' => 'Jana Rowe',
            'domain_id' => 251340583,
            'description' => 'accusantium',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/smartlink/category', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->smartLinkAddCategory($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testSmartLinkCategoryFailsWhenNameIsNotPassed(): void
    {
        $otherManagingProvider = new OtherManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'name' is required");

        $otherManagingProvider->smartLinkAddCategory([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkCategoryResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/smartlink/category')
            ->willReturn(
                [
                    'status' => 1,
                    'data' => $attributes,
                ]
            );

        $otherManagingProvider = new OtherManagingProvider($transport);
        $response = $otherManagingProvider->smartLinkAddCategory(['name' => 'Jana Rowe']);

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
    public function testSmartLinkCategoryFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $otherManagingProvider = new OtherManagingProvider($transport);

        $this->expectException($exceptionClass);

        $otherManagingProvider->smartLinkAddCategory(
            [
                'name' => 'Jana Rowe',
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
