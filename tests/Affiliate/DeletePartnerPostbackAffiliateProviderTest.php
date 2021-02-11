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
* Class DeletePartnerPostbackAffiliateProviderTest
*/
class DeletePartnerPostbackAffiliateProviderTest extends TestCase
{
    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testDeletePartnerPostbackResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            'id' => 960,
            'url' => 'http://affise.com',
            'offer_id' => '4',
            'status' => 'confirmed',
            'goal' => 'ab',
            'created' => '2017-06-20 02:17:58',
            'updated_at' => '2017-06-20 02:17:58',
            'forced' => '0',
            'pid' => '1',
        ];

        $transport->expects($this->once())
            ->method('delete')
            ->with('/3.0/partner/postback/960/remove')
            ->willReturn([
                'status' => 1,
                'postback' => $attributes,
            ]);

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->deletePartnerPostback(960);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(DeletePartnerPostbackDto::class, $response->getData());
        $this->assertEquals(new DeletePartnerPostbackDto($attributes), $response->getData());
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
    public function testDeletePartnerPostbackFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('delete')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->deletePartnerPostback(960);
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
