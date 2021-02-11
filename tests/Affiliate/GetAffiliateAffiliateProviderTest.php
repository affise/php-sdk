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
 * Class GetAffiliateAffiliateProviderTest
 */
class GetAffiliateAffiliateProviderTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetAffiliateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = [
            'id' => 1,
            'created_at' => '2015-08-25 15:10:16',
            'updated_at' => '0000-00-00 00:00:00',
            'email' => 'demo@demo.com',
            'login' => 'demo@demo.com',
            'ref_percent' => 'aliquam',
            'notes' => '',
            'level' => 1,
            'status' => 'active',
            'payment_systems' => [],
            'customFields' => [],
            'balance' => [
                'RUB' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                'USD' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                'EUR' => ['balance' => 0, 'hold' => 0, 'available' => 0],
            ],
            'offersCount' => 0,
            'api_key' => '39ab3b372f26e65f4caa4f36e953b912d460343b',
            'address_1' => '68075 Donavon Bridge',
            'address_2' => '8921 Quitzon Trafficway Suite 687',
            'city' => 'Wehnerview',
            'country' => 'Belarus',
            'zip_code' => 'sint',
            'phone' => 'beatae',
            'ref' => '0',
        ];

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.0/admin/partner/1')
            ->willReturn(
                [
                    'status' => 1,
                    'partner' => $attributes,
                    'id' => 1,
                ]
            );

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->getAffiliate(1);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(AffiliateDto::class, $response->getData());
        $this->assertEquals(new AffiliateDto($attributes), $response->getData());
        $this->assertEquals(1, $response->getId());
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
    public function testGetAffiliateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->getAffiliate(1);
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
