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
use PHPUnit\Framework\TestCase;

/**
* Class SendPasswordToAdvertiserAdvertiserProviderTest
*/
class SendPasswordToAdvertiserAdvertiserProviderTest extends TestCase
{

    /**
    * @return void
    *
    * @throws \Affise\Sdk\Exception\TransportException
    */
    public function testSendPasswordToAdvertiserResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser/b04c5edc9c4f6480b64c017899436ad3c39bee2a/sendpass')
            ->willReturn([
                'status' => 1,
                'message' => 'Email send successfully'
            ]);

        $advertiserProvider = new AdvertiserProvider($transport);
        $response = $advertiserProvider->sendPasswordToAdvertiser('b04c5edc9c4f6480b64c017899436ad3c39bee2a');

        $this->assertEquals(1, $response->getStatus());
        $this->assertEquals('Email send successfully', $response->getMessage());
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
    public function testSendPasswordToAdvertiserFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $advertiserProvider = new AdvertiserProvider($transport);

        $this->expectException($exceptionClass);

        $advertiserProvider->sendPasswordToAdvertiser('b04c5edc9c4f6480b64c017899436ad3c39bee2a');
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
