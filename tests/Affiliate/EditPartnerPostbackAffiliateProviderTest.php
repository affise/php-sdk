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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
* Class EditPartnerPostbackAffiliateProviderTest
*/
class EditPartnerPostbackAffiliateProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @psalm-suppress InvalidArgument
    */
    public function testEditPartnerPostbackFailsWhenFiltersAreNotSet(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $affiliateProvider->editPartnerPostback(960, []);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testEditPartnerPostbackWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'url' => 'http://affise.com',
            'status' => 'confirmed',
            'goal' => 'quia',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/postback/960', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->editPartnerPostback(960, $filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testEditPartnerPostbackFailsWhenUrlIsNotPassed(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'url' is required");

        $affiliateProvider->editPartnerPostback(960, [
        ]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testEditPartnerPostbackContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'url' => 'http://affise.com',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/postback/960', $filters, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->editPartnerPostback(960, $filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testEditPartnerPostbackResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            'id' => 960,
            'url' => 'http://affise.com',
            'status' => 'confirmed',
            'goal' => 'non',
            'created' => '2017-06-20 02:17:58',
            'updated_at' => '2017-06-20 02:17:58',
            'forced' => '0',
            'pid' => '1',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/postback/960')
            ->willReturn([
                'status' => 1,
                'postback' => $attributes,
            ]);

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->editPartnerPostback(960, [
            'url' => 'http://affise.com',
        ]);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(EditPartnerPostbackDto::class, $response->getData());
        $this->assertEquals(new EditPartnerPostbackDto($attributes), $response->getData());
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
    public function testEditPartnerPostbackFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->editPartnerPostback(960, [
            'url' => 'http://affise.com',
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
