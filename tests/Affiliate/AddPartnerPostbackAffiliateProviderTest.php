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
* Class AddPartnerPostbackAffiliateProviderTest
*/
class AddPartnerPostbackAffiliateProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @psalm-suppress InvalidArgument
    */
    public function testAddPartnerPostbackFailsWhenFiltersAreNotSet(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $affiliateProvider->addPartnerPostback([]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAddPartnerPostbackWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'offer_id' => '906',
            'url' => 'http://affise.com',
            'status' => 'by_creating',
            'goal' => 'est',
            'pid' => '610',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/postback', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->addPartnerPostback($filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAddPartnerPostbackFailsWhenUrlIsNotPassed(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'url' is required");

        $affiliateProvider->addPartnerPostback([
            'pid' => '610',
        ]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAddPartnerPostbackFailsWhenPidIsNotPassed(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'pid' is required");

        $affiliateProvider->addPartnerPostback([
            'url' => 'http://affise.com',
        ]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAddPartnerPostbackContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'url' => 'http://affise.com',
            'pid' => '610',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/postback', $filters, ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->addPartnerPostback($filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAddPartnerPostbackResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            'id' => 960,
            'url' => 'http://affise.com',
            'status' => 'by_creating',
            'goal' => 'voluptatem',
            'created' => '2017-06-20 02:17:58',
            'updated_at' => '2017-06-20 02:17:58',
            'forced' => '0',
            'pid' => '1',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/partner/postback')
            ->willReturn([
                'status' => 1,
                'postback' => $attributes,
            ]);

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->addPartnerPostback([
            'url' => 'http://affise.com',
            'pid' => '610',
        ]);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(AddPartnerPostbackDto::class, $response->getData());
        $this->assertEquals(new AddPartnerPostbackDto($attributes), $response->getData());
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
    public function testAddPartnerPostbackFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->addPartnerPostback([
            'url' => 'http://affise.com',
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
