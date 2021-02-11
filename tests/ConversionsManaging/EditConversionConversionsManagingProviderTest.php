<?php

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

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
 * Class EditConversionConversionsManagingProviderTest
 */
class EditConversionConversionsManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'ids' => [
                '59359e1d7e28feb7568b456a',
            ],
            'status' => 'confirmed',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testEditConversionFailsWhenFiltersAreNotSet(): void
    {
        $conversionsManagingProvider = new ConversionsManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $conversionsManagingProvider->editConversion([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditConversionWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'ids' => ['59359e1d7e28feb7568b456a'],
            'status' => 'reprehenderit',
            'currency' => 'incidunt',
            'payouts' => 1235913289,
            'revenue' => 1499743395,
            'comment' => 'dolor',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversion/edit', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $conversionsManagingProvider->editConversion($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testEditConversionFailsWhenIdsIsNotPassed(): void
    {
        $conversionsManagingProvider = new ConversionsManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'ids' is required");

        $conversionsManagingProvider->editConversion([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditConversionContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'ids' => ['59359e1d7e28feb7568b456a'],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversion/edit', $filters, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $conversionsManagingProvider->editConversion($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditConversionResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversion/edit')
            ->willReturn(
                [
                    'status' => 1,
                    'data' => static::$attributes,
                    'message' => 'Conversion changes will take a few minutes',
                ]
            );

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $response = $conversionsManagingProvider->editConversion([
            'ids' => ['59359e1d7e28feb7568b456a'],
        ]);

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals(new EditConversionDto(static::$attributes), $response->getData());
        $this->assertEquals('Conversion changes will take a few minutes', $response->getMessage());
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
    public function testEditConversionFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);

        $this->expectException($exceptionClass);

        $conversionsManagingProvider->editConversion([
            'ids' => ['59359e1d7e28feb7568b456a'],
        ]);
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
