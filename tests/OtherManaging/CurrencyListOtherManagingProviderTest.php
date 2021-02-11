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
* Class CurrencyListOtherManagingProviderTest
*/
class CurrencyListOtherManagingProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testCurrencyListShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $currencies = [
            'RUB' => 59.312599,
            'USD' => 1,
            'AED' => 3.672497,
            'AFN' => 66.669998,
            'ALL' => 125.800003,
            'AMD' => 485.299988,
            'ANG' => 1.769851,
            'AOA' => 165.080994,
        ];
        
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/currency', [])
            ->willReturn([
                'status' => 1,
                'quotes' => $currencies,
            ]);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->currencyList([]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testCurrencyListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'get_only_active' => 560363462,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/currency', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $otherManagingProvider->currencyList($filters);
    }

 /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testCurrencyListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $currencies = [
            'RUB' => 59.312599,
            'USD' => 1,
            'AED' => 3.672497,
            'AFN' => 66.669998,
            'ALL' => 125.800003,
            'AMD' => 485.299988,
            'ANG' => 1.769851,
            'AOA' => 165.080994,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/currency')
            ->willReturn([
                'status' => 1,
                'quotes' => $currencies,
            ]);

        $otherManagingProvider = new OtherManagingProvider($transport);
        $response = $otherManagingProvider->currencyList();

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals($currencies, $response->getData());
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
    public function testCurrencyListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherManagingProvider = new OtherManagingProvider($transport);

        $this->expectException($exceptionClass);

        $otherManagingProvider->currencyList();
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
