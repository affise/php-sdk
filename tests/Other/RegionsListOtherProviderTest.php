<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

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
 * Class RegionsListOtherProviderTest
 */
class RegionsListOtherProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'id' => 2,
                'name' => 'Alaska',
                'country_code' => 'US',
            ],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testRegionsListFailsWhenFiltersAreNotSet(): void
    {
        $otherProvider = new OtherProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $otherProvider->regionsList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRegionsListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'country' => ['US'],
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/regions', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherProvider = new OtherProvider($transport);
        $otherProvider->regionsList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testRegionsListFailsWhenCountryIsNotPassed(): void
    {
        $otherProvider = new OtherProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'country' is required");

        $otherProvider->regionsList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRegionsListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/regions')
            ->willReturn(
                [
                    'status' => 1,
                    'regions' => $attributes,
                ]
            );

        $otherProvider = new OtherProvider($transport);
        $response = $otherProvider->regionsList(['country' => ['US']]);

        $expectedData = array_map(fn(array $a) => new RegionsListDto($a), $attributes);

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
    public function testRegionsListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherProvider = new OtherProvider($transport);

        $this->expectException($exceptionClass);

        $otherProvider->regionsList(['country' => ['US']]);
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
