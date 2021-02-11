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
 * Class ImportSingleConversionConversionsManagingProviderTest
 */
class ImportSingleConversionConversionsManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'offer' => 1000,
            'pid' => 500,
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testImportSingleConversionFailsWhenFiltersAreNotSet(): void
    {
        $conversionsManagingProvider = new ConversionsManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $conversionsManagingProvider->importSingleConversion([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportSingleConversionWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'offer' => 1087329360,
            'pid' => 579883616,
            'action_id' => 'unde',
            'click_id' => 'occaecati',
            'goal' => 514059946,
            'ip' => 'ut',
            'ua' => 'sunt',
            'comment' => 'voluptas',
            'sum' => 288500262,
            'status' => 'iste',
            'custom_field_1' => 'soluta',
            'custom_field_2' => 'iure',
            'custom_field_3' => 'occaecati',
            'custom_field_4' => 'incidunt',
            'custom_field_5' => 'aut',
            'custom_field_6' => 'sed',
            'custom_field_7' => 'placeat',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversion/import', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $conversionsManagingProvider->importSingleConversion($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportSingleConversionFailsWhenOfferIsNotPassed(): void
    {
        $conversionsManagingProvider = new ConversionsManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'offer' is required");

        $conversionsManagingProvider->importSingleConversion(
            [
                'pid' => 579883616,
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportSingleConversionFailsWhenPidIsNotPassed(): void
    {
        $conversionsManagingProvider = new ConversionsManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'pid' is required");

        $conversionsManagingProvider->importSingleConversion(
            [
                'offer' => 1087329360,
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportSingleConversionContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'offer' => 1087329360,
            'pid' => 579883616,
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversion/import', $filters, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $conversionsManagingProvider->importSingleConversion($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportSingleConversionResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversion/import')
            ->willReturn(
                [
                    'status' => 1,
                    'data' => $attributes,
                    'message' => 'Conversion import will take a few minutes',
                ]
            );

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $response = $conversionsManagingProvider->importSingleConversion(
            [
                'offer' => 1087329360,
                'pid' => 579883616,
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals(new ConversionDto($attributes), $response->getData());
        $this->assertEquals('Conversion import will take a few minutes', $response->getMessage());
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
    public function testImportSingleConversionFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);

        $this->expectException($exceptionClass);

        $conversionsManagingProvider->importSingleConversion(
            [
                'offer' => 1087329360,
                'pid' => 579883616,
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
