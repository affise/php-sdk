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
 * Class DisableAffiliateOfferManagingProviderTest
 */
class DisableAffiliateOfferManagingProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [

        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testDisableAffiliateFailsWhenFiltersAreNotSet(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $offerManagingProvider->disableAffiliate([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDisableAffiliateWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'offer_id' => 699259157,
            'pid' => 1747278716,
            'notice' => 1169015360,
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/offer/disable-affiliate', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->disableAffiliate($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDisableAffiliateFailsWhenOfferIdIsNotPassed(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'offer_id' is required");

        $offerManagingProvider->disableAffiliate(
            [
                'pid' => 1747278716,
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDisableAffiliateFailsWhenPidIsNotPassed(): void
    {
        $offerManagingProvider = new OfferManagingProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'pid' is required");

        $offerManagingProvider->disableAffiliate(
            [
                'offer_id' => 699259157,
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDisableAffiliateContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'offer_id' => 699259157,
            'pid' => 1747278716,
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/offer/disable-affiliate', $data, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $offerManagingProvider = new OfferManagingProvider($transport);
        $offerManagingProvider->disableAffiliate($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testDisableAffiliateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/offer/disable-affiliate')
            ->willReturn(
                [
                    'status' => 1,
                    'message' => 'Request for offer 935 is successfully',
                ]
            );

        $offerManagingProvider = new OfferManagingProvider($transport);
        $response = $offerManagingProvider->disableAffiliate(
            [
                'offer_id' => 699259157,
                'pid' => 1747278716,
            ]
        );

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals('Request for offer 935 is successfully', $response->getMessage());
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
    public function testDisableAffiliateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $offerManagingProvider = new OfferManagingProvider($transport);

        $this->expectException($exceptionClass);

        $offerManagingProvider->disableAffiliate(
            [
                'offer_id' => 699259157,
                'pid' => 1747278716,
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
