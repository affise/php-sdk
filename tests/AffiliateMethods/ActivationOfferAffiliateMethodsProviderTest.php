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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class ActivationOfferAffiliateMethodsProviderTest
 */
class ActivationOfferAffiliateMethodsProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testActivationOfferFailsWhenFiltersAreNotSet(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $affiliateMethodsProvider->activationOffer([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testActivationOfferWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'offer_id' => 1866474302,
            'comment' => 'commodi',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/activation/offer', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $affiliateMethodsProvider->activationOffer($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testActivationOfferFailsWhenOfferIdIsNotPassed(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'offer_id' is required");

        $affiliateMethodsProvider->activationOffer(
            [
                'comment' => 'commodi',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testActivationOfferFailsWhenCommentIsNotPassed(): void
    {
        $affiliateMethodsProvider = new AffiliateMethodsProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'comment' is required");

        $affiliateMethodsProvider->activationOffer(
            [
                'offer_id' => 1866474302,
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testActivationOfferResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/activation/offer', $this->anything(), ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willReturn(
                [
                    'status' => 1,
                    'message' => 'Request is successfully',
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $response = $affiliateMethodsProvider->activationOffer(
            [
                'offer_id' => 1866474302,
                'comment' => 'commodi',
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals('Request is successfully', $response->getMessage());
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
    public function testActivationOfferFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateMethodsProvider->activationOffer(
            [
                'offer_id' => 1866474302,
                'comment' => 'commodi',
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
