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

/**
* Class ChangePartnerApiKeyAffiliateProviderTest
*/
class ChangePartnerApiKeyAffiliateProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testChangePartnerApiKeyResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            'id' => 1,
            'api_key' => '97366c88ad626fdf4c73687d2cae5394',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.1/partner/api_key')
            ->willReturn([
                'status' => 1,
                'user' => $attributes,
            ]);

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->changePartnerApiKey();

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(ChangePartnerApiKeyDto::class, $response->getData());
        $this->assertEquals(new ChangePartnerApiKeyDto($attributes), $response->getData());
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
    public function testChangePartnerApiKeyFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->changePartnerApiKey();
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
