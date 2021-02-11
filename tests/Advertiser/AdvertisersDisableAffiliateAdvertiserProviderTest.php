<?php 

declare(strict_types=1);

namespace Affise\Sdk\Advertiser;

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
* Class AdvertisersDisableAffiliateAdvertiserProviderTest
*/
class AdvertisersDisableAffiliateAdvertiserProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @psalm-suppress InvalidArgument
    */
    public function testAdvertisersDisableAffiliateFailsWhenFiltersAreNotSet(): void
    {
        $advertiserProvider = new AdvertiserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $advertiserProvider->advertisersDisableAffiliate([]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAdvertisersDisableAffiliateWhenRequiredFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'advertisers_id' => '56fce8ab3b7d9b95588b4568',
            'pid' => '610',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser/disable-affiliate', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $advertiserProvider = new AdvertiserProvider($transport);
        $advertiserProvider->advertisersDisableAffiliate($filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAdvertisersDisableAffiliateFailsWhenAdvertisersIdIsNotPassed(): void
    {
        $advertiserProvider = new AdvertiserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'advertisers_id' is required");

        $advertiserProvider->advertisersDisableAffiliate([
            'pid' => '610',
        ]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAdvertisersDisableAffiliateFailsWhenPidIsNotPassed(): void
    {
        $advertiserProvider = new AdvertiserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'pid' is required");

        $advertiserProvider->advertisersDisableAffiliate([
            'advertisers_id' => '56fce8ab3b7d9b95588b4568',
        ]);
    }
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAdvertisersDisableAffiliateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser/disable-affiliate')
            ->willReturn([
                'status' => 1,
                'message' => 'Request is successfully'
            ]);

        $advertiserProvider = new AdvertiserProvider($transport);
        $response = $advertiserProvider->advertisersDisableAffiliate([
            'advertisers_id' => '56fce8ab3b7d9b95588b4568',
            'pid' => '610',
        ]);

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals('Request is successfully', $response->getMessage());
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
    public function testAdvertisersDisableAffiliateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $advertiserProvider = new AdvertiserProvider($transport);

        $this->expectException($exceptionClass);

        $advertiserProvider->advertisersDisableAffiliate([
            'advertisers_id' => '56fce8ab3b7d9b95588b4568',
            'pid' => '610',
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
