<?php

declare(strict_types=1);

namespace Affise\Sdk;

use Affise\Sdk\Advertiser\AdvertiserProvider;
use Affise\Sdk\AdvertiserBilling\AdvertiserBillingProvider;
use Affise\Sdk\Affiliate\AffiliateProvider;
use Affise\Sdk\AffiliateMethods\AffiliateMethodsProvider;
use Affise\Sdk\ConversionsManaging\ConversionsManagingProvider;
use Affise\Sdk\OfferManaging\OfferManagingProvider;
use Affise\Sdk\Offers\OffersProvider;
use Affise\Sdk\Other\OtherProvider;
use Affise\Sdk\OtherManaging\OtherManagingProvider;
use Affise\Sdk\Presets\PresetsProvider;
use Affise\Sdk\Statistics\StatisticsProvider;
use Affise\Sdk\Transport\GuzzleTransport;
use Affise\Sdk\Transport\TransportInterface;
use Affise\Sdk\User\UserProvider;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class ApiTest
 */
class ApiTest extends TestCase
{
    public function testCreate(): void
    {
        $api = Api::create('http://example.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');
        $reflectionClass = new ReflectionClass(Api::class);
        $property = $reflectionClass->getProperty('transport');
        $property->setAccessible(true);

        $this->assertInstanceOf(GuzzleTransport::class, $property->getValue($api));
    }

    public function testCreateDifferentInstances(): void
    {
        $first = Api::create('http://example.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');
        $second = Api::create('http://example.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

        $this->assertNotSame($first, $second);
    }

    public function testCreateWhenBaseUriIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Api::create('', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');
    }

    public function testCreateWhenApiKeyIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Api::create('http://example.com', '');
    }

    public function testProviderInstancesIsEmpty(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));
        $reflectionClass = new ReflectionClass(Api::class);
        $property = $reflectionClass->getProperty('providerInstances');
        $property->setAccessible(true);

        $this->assertEmpty($property->getValue($api));
    }

    public function testGetUsersProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(UserProvider::class, $api->users);
        $this->assertSame($api->users, $api->users);
    }

    public function testGetAdvertiserProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(AdvertiserProvider::class, $api->advertisers);
        $this->assertSame($api->advertisers, $api->advertisers);
    }

    public function testGetAffiliateProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(AffiliateProvider::class, $api->affiliates);
        $this->assertSame($api->affiliates, $api->affiliates);
    }

    public function testGetOffersProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(OffersProvider::class, $api->offers);
        $this->assertSame($api->offers, $api->offers);
    }

    public function testGetOfferManagingProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(OfferManagingProvider::class, $api->offerManaging);
        $this->assertSame($api->offerManaging, $api->offerManaging);
    }

    public function testGetAdvertiserBillingProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(AdvertiserBillingProvider::class, $api->advertiserBilling);
        $this->assertSame($api->advertiserBilling, $api->advertiserBilling);
    }

    public function testGetConversionsManagingProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(ConversionsManagingProvider::class, $api->conversions);
        $this->assertSame($api->conversions, $api->conversions);
    }

    public function testGetPresetsProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(PresetsProvider::class, $api->presets);
        $this->assertSame($api->presets, $api->presets);
    }

    public function testGetOtherProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(OtherProvider::class, $api->other);
        $this->assertSame($api->other, $api->other);
    }

    public function testGetOtherManagingProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(OtherManagingProvider::class, $api->otherManaging);
        $this->assertSame($api->otherManaging, $api->otherManaging);
    }

    public function testGetAffiliateMethodsProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(AffiliateMethodsProvider::class, $api->affiliateMethods);
        $this->assertSame($api->affiliateMethods, $api->affiliateMethods);
    }

    public function testGetStatisticsProvider(): void
    {
        $api = new Api($this->createStub(TransportInterface::class));

        $this->assertInstanceOf(StatisticsProvider::class, $api->statistics);
        $this->assertSame($api->statistics, $api->statistics);
    }
}

