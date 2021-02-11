<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\OtherManaging\SmartLinkCategoryDto;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class SmartLinkCategoriesAffiliateMethodsProviderTest
 */
class SmartLinkCategoriesAffiliateMethodsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                '_id' => '595e3b547e28fede7b8b456c',
                'name' => 'test1',
                'domain' => 'voluptatibus',
                'use_https' => false,
                'created_at' => '2017-07-06 13:29:56',
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkCategoriesShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/partner/smartlink/categories', [])
            ->willReturn(
                [
                    'status' => 1,
                    'data' => static::$attributes,
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $affiliateMethodsProvider->smartLinkCategories([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkCategoriesWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'id' => '924a5c8bd7ae0ec59396dbd2300ed21a360c4a3c',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/partner/smartlink/categories', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $affiliateMethodsProvider->smartLinkCategories($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testSmartLinkCategoriesResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/partner/smartlink/categories')
            ->willReturn(
                [
                    'status' => 1,
                    'data' => $attributes,
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $response = $affiliateMethodsProvider->smartLinkCategories();

        $expectedData = array_map(fn(array $a) => new SmartLinkCategoryDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
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
    public function testSmartLinkCategoriesFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateMethodsProvider->smartLinkCategories();
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
