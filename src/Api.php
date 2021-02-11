<?php

declare(strict_types=1);

namespace Affise\Sdk;

use Affise\Sdk\Advertiser\AdvertiserProvider;
use Affise\Sdk\AdvertiserBilling\AdvertiserBillingProvider;
use Affise\Sdk\Affiliate\AffiliateProvider;
use Affise\Sdk\AffiliateMethods\AffiliateMethodsProvider;
use Affise\Sdk\ConversionsManaging\ConversionsManagingProvider;
use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\OfferManaging\OfferManagingProvider;
use Affise\Sdk\Offers\OffersProvider;
use Affise\Sdk\Other\OtherProvider;
use Affise\Sdk\OtherManaging\OtherManagingProvider;
use Affise\Sdk\Presets\PresetsProvider;
use Affise\Sdk\Statistics\StatisticsProvider;
use Affise\Sdk\Transport\GuzzleTransport;
use Affise\Sdk\Transport\TransportInterface;
use Affise\Sdk\User\UserProvider;
use LogicException;

/**
 * Class Api
 * 
 * @property-read UserProvider $users
 * @property-read AdvertiserProvider $advertisers
 * @property-read AffiliateProvider $affiliates
 * @property-read OffersProvider $offers
 * @property-read OfferManagingProvider $offerManaging
 * @property-read AdvertiserBillingProvider $advertiserBilling
 * @property-read ConversionsManagingProvider $conversions
 * @property-read PresetsProvider $presets
 * @property-read OtherProvider $other
 * @property-read OtherManagingProvider $otherManaging
 * @property-read AffiliateMethodsProvider $affiliateMethods
 * @property-read StatisticsProvider $statistics
 */
class Api
{
    /**
     * @var \Affise\Sdk\Transport\TransportInterface
     */
    protected TransportInterface $transport;

    /**
     * @var array<string, string>
     * @psalm-var array<string, class-string<\Affise\Sdk\Helper\AbstractProvider>>
     */
    protected array $providerPropertiesMap = [
        'users' => UserProvider::class,
        'advertisers' => AdvertiserProvider::class,
        'affiliates' => AffiliateProvider::class,
        'offers' => OffersProvider::class,
        'offerManaging' => OfferManagingProvider::class,
        'advertiserBilling' => AdvertiserBillingProvider::class,
        'conversions' => ConversionsManagingProvider::class,
        'presets' => PresetsProvider::class,
        'other' => OtherProvider::class,
        'otherManaging' => OtherManagingProvider::class,
        'affiliateMethods' => AffiliateMethodsProvider::class,
        'statistics' => StatisticsProvider::class,
    ];

    /**
     * @var array<string, \Affise\Sdk\Helper\AbstractProvider>
     */
    protected array $providerInstances = [];

    /**
     * Api constructor.
     *
     * @param \Affise\Sdk\Transport\TransportInterface $transport
     */
    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * Creates an instance with default transport.
     *
     * @param string $baseUri
     * @param string $apiKey
     *
     * @return \Affise\Sdk\Api
     */
    public static function create(string $baseUri, string $apiKey): Api
    {
        return new self(new GuzzleTransport($baseUri, $apiKey));
    }

    /**
     * Proxies to the provider instances.
     *
     * @param string $name
     *
     * @return \Affise\Sdk\Helper\AbstractProvider
     */
    public function __get(string $name): AbstractProvider
    {
        if (isset($this->providerInstances[$name])) {
            return $this->providerInstances[$name];
        }

        if (isset($this->providerPropertiesMap[$name])) {
            return $this->providerInstances[$name] = $this->createProviderInstance(
                $this->providerPropertiesMap[$name]
            );
        }

        throw new LogicException("Property {$name} does not exist");
    }

    /**
     * @param string $providerClass
     * @psalm-param class-string<\Affise\Sdk\Helper\AbstractProvider> $providerClass
     *
     * @return \Affise\Sdk\Helper\AbstractProvider
     *
     * @psalm-suppress UnsafeInstantiation
     */
    protected function createProviderInstance(string $providerClass): AbstractProvider
    {
        return new $providerClass($this->transport);
    }
}
