<?php

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

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
 * Class RemoveCreativeFromOfferOfferManagingProviderTest
 */
class RemoveCreativeFromOfferOfferManagingProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testRemoveCreativeFromOfferFailsWhenFiltersAreNotSet(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $offerManagingProvider->removeCreativeFromOffer('fde58c42f4c0437d39641f008681b193d5e548a2', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRemoveCreativeFromOfferWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'creatives' => [1959289461],
        ];

        $transport->expects($this->once())
            ->method('delete')
            ->with('/3.0/admin/offer/fde58c42f4c0437d39641f008681b193d5e548a2/remove-creative', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->removeCreativeFromOffer('fde58c42f4c0437d39641f008681b193d5e548a2', $data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testRemoveCreativeFromOfferFailsWhenCreativesIsNotPassed(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'creatives' is required");

        $offerManagingProvider->removeCreativeFromOffer('fde58c42f4c0437d39641f008681b193d5e548a2', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testRemoveCreativeFromOfferResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('delete')
            ->with('/3.0/admin/offer/fde58c42f4c0437d39641f008681b193d5e548a2/remove-creative')
            ->willReturn(
                [
                    'status' => 1,
                    'removed' => [1, 2],
                ]
            );

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->removeCreativeFromOffer(
            'fde58c42f4c0437d39641f008681b193d5e548a2',
            [
                'creatives' => [1959289461],
            ]
        );
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
    public function testRemoveCreativeFromOfferFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('delete')->willThrowException(new $exceptionClass());

        $offerManagingProvider = new OfferManagingProvider($transport);

        $this->expectException($exceptionClass);

        $offerManagingProvider->removeCreativeFromOffer(
            'fde58c42f4c0437d39641f008681b193d5e548a2',
            [
                'creatives' => [1959289461],
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
