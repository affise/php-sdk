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
* Class CurrencyListExtendedOtherManagingProviderTest
*/
class CurrencyListExtendedOtherManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                '_id' => 2,
                'code' => 'USD',
                'active' => true,
                'default' => true,
                'rate' => 1,
            ],
        ];
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testCurrencyListExtendedShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/currency', ['extended' => 1])
            ->willReturn([
                'status' => 1,
                'quotes' => static::$attributes,
            ]);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->currencyListExtended([]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testCurrencyListExtendedWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'get_only_active' => 1,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/currency', $filters + ['extended' => 1])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->currencyListExtended($filters);
    }

 /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testCurrencyListExtendedResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/currency')
            ->willReturn([
                'status' => 1,
                'quotes' => $attributes,
            ]);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $response = $otherManagingProvider->currencyListExtended();

        $expectedData = array_map(fn(array $a) => new CurrencyListDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
    }

    /**
    * @param string $exceptionClass
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
    public function testCurrencyListExtendedFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherManagingProvider = new OtherManagingProvider($transport);

        $this->expectException($exceptionClass);

        $otherManagingProvider->currencyListExtended();
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
