<?php 

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
* Class UpdatePartnerLocaleAffiliateProviderTest
*/
class UpdatePartnerLocaleAffiliateProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testUpdatePartnerLocaleShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/1/locale', [])
            ->willReturn([
                'status' => 1,
                'message' => ['test message'],
            ]);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->updatePartnerLocale(1, []);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testUpdatePartnerLocaleWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'lang' => 'fugiat',
            'timezone' => 'America/Cancun',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/1/locale', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->updatePartnerLocale(1, $filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testUpdatePartnerLocaleContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'lang' => 'fugiat',
            'timezone' => 'America/Cancun',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/1/locale', $filters, ['Content-Type' => 'multipart/form-data'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->updatePartnerLocale(1, $filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testUpdatePartnerLocaleResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/1/locale')
            ->willReturn([
                'status' => 1,
                'message' => ['test message'],
            ]);

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->updatePartnerLocale(1);

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals(['test message'], $response->getMessage());
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
    public function testUpdatePartnerLocaleFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->updatePartnerLocale(1);
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
