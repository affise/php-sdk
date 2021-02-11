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
 * Class ISPListOtherProviderTest
 */
class ISPListOtherProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            [
                'country' => 'KZ',
                'name' => 'Dr. Talia Flatley V',
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
    public function testISPListFailsWhenFiltersAreNotSet(): void
    {
        $otherProvider = new OtherProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $otherProvider->ispList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testISPListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'country' => 'US',
            'q' => 'eius',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/isp', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $otherProvider = new OtherProvider($transport);
        $otherProvider->ispList($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testISPListFailsWhenCountryIsNotPassed(): void
    {
        $otherProvider = new OtherProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'country' is required");

        $otherProvider->ispList([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testISPListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/isp')
            ->willReturn(
                [
                    'status' => 1,
                    'isps' => $attributes,
                    'pagination' => [
                        'per_page' => 1,
                        'total_count' => 1,
                        'page' => 1
                    ],
                ]
            );

        $otherProvider = new OtherProvider($transport);
        $response = $otherProvider->ispList(['country' => 'US']);

        $expectedData = array_map(fn(array $a) => new ISPListDto($a), $attributes);

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
    public function testISPListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $otherProvider = new OtherProvider($transport);

        $this->expectException($exceptionClass);

        $otherProvider->ispList(['country' => 'US']);
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
