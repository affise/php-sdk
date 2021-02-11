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
 * Class ImportMultipleConversionsConversionsManagingProviderTest
 */
class ImportMultipleConversionsConversionsManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'list' => [
                [
                    'offer' => 1000,
                    'pid' => 500,
                ],
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
    public function testImportMultipleConversionsFailsWhenFiltersAreNotSet(): void
    {
        $conversionsManagingProvider = new ConversionsManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $conversionsManagingProvider->importMultipleConversions([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportMultipleConversionsWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'list' => [
                [
                    'offer' => 1781208928,
                    'pid' => 1659911885,
                    'action_id' => 'saepe',
                    'click_id' => 'deleniti',
                    'goal' => 1384605668,
                    'ip' => 'aut',
                    'ua' => 'eum',
                    'comment' => 'et',
                    'sum' => 1414660913,
                    'status' => 'id',
                    'custom_field_1' => 'doloribus',
                    'custom_field_2' => 'quas',
                    'custom_field_3' => 'ipsum',
                    'custom_field_4' => 'unde',
                    'custom_field_5' => 'cumque',
                    'custom_field_6' => 'quaerat',
                    'custom_field_7' => 'dolorem',
                ],
            ],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversions/import', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $conversionsManagingProvider->importMultipleConversions($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportMultipleConversionsContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'list' => [
                [
                    'offer' => 1781208928,
                    'pid' => 1659911885,
                ],
            ],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversions/import', $filters, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $conversionsManagingProvider->importMultipleConversions($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testImportMultipleConversionsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/conversions/import')
            ->willReturn(
                [
                    'status' => 1,
                    'data' => $attributes,
                    'message' => 'Conversion import will take a few minutes',
                ]
            );

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);
        $response = $conversionsManagingProvider->importMultipleConversions(
            [
                'list' => [
                    [
                        'offer' => 1781208928,
                        'pid' => 1659911885,
                    ],
                ],
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals(new ImportMultipleConversionsDto($attributes), $response->getData());
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
    public function testImportMultipleConversionsFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $conversionsManagingProvider = new ConversionsManagingProvider($transport);

        $this->expectException($exceptionClass);

        $conversionsManagingProvider->importMultipleConversions(
            [
                'list' => [
                    [
                        'offer' => 1781208928,
                        'pid' => 1659911885,
                    ],
                ],
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
