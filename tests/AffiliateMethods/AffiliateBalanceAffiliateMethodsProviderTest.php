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
 * Class AffiliateBalanceAffiliateMethodsProviderTest
 */
class AffiliateBalanceAffiliateMethodsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'balance' => ['USD' => 0, 'EUR' => 0, 'RUB' => 16968],
            'hold' => ['USD' => 0, 'EUR' => 0, 'RUB' => 1234],
            'available' => ['USD' => 0, 'EUR' => 0, 'RUB' => 15734],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAffiliateBalanceResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/balance')
            ->willReturn(
                [
                    'status' => 1,
                    'balance' => $attributes,
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $response = $affiliateMethodsProvider->affiliateBalance();

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(AffiliateBalanceDto::class, $response->getData());
        $this->assertEquals(new AffiliateBalanceDto($attributes), $response->getData());
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
    public function testAffiliateBalanceFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateMethodsProvider->affiliateBalance();
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
