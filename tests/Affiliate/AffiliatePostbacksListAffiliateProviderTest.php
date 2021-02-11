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
* Class AffiliatePostbacksListAffiliateProviderTest
*/
class AffiliatePostbacksListAffiliateProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @psalm-suppress InvalidArgument
    */
    public function testAffiliatePostbacksListFailsWhenFiltersAreNotSet(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $affiliateProvider->affiliatePostbacksList([]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAffiliatePostbacksListWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'partner_id' => 927823176,
            'limit' => 9,
            'page' => 7,
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/postbacks', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->affiliatePostbacksList($filters);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
    */
    public function testAffiliatePostbacksListFailsWhenPartnerIdIsNotPassed(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'partner_id' is required");

        $affiliateProvider->affiliatePostbacksList([]);
    }

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testAffiliatePostbacksListResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            [
                'id' => 8,
                'url' => 'http://affise.com',
                'offer_id' => '17',
                'status' => 'pending',
                'goal' => '1',
                'created' => '2018-01-30 18:31:52',
                'forced' => '0',
            ]
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/postbacks')
            ->willReturn([
                'status' => 1,
                'postbacks' => $attributes,
                'pagination' => ['per_page' => 1, 'total_count' => 1, 'page' => 1],
            ]);

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->affiliatePostbacksList([
            'partner_id' => 927823176,
        ]);

        $expectedData = array_map(fn(array $a) => new AffiliatePostbacksListDto($a), $attributes);

        $this->assertEquals(1, $response->getStatus());
        $this->assertIsArray($response->getData());
        $this->assertEquals($expectedData, $response->getData());
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
    public function testAffiliatePostbacksListFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->affiliatePostbacksList([
            'partner_id' => 927823176,
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
