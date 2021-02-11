# affise_sdk_php

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  * [Create api instance](#create-api-instance)
  * [Call endpoints](#call-endpoints)
  * [Upload files](#upload-files)
- [List of providers](#list-of-providers)
- [Advanced](#advanced)
    * [Providers](#providers)
    * [Transport layer](#transport-layer)
    * [Customize api transport](#customize-api-transport)

## Requirements

- PHP >=7.4
- Guzzle >=6.0
- Any PSR-17 and PSR-18 Implementation (optional)

## Installation

```bash
composer require affise/php-sdk
```

## Usage

### Create api instance

```php
use Affise\Sdk\Api;

require_once __DIR__ . '/vendor/autoload.php';

$api = Api::create('https://YOUR_API_DOMAIN', 'YOUR_API_KEY');
```

### Call endpoints

```php
$response = $api->users->usersList(['limit' => 10]);

var_dump($response->getStatus(), $response->getData());
```

```php
$response = $api->statistics->byAdvertiser(['filter' => ['date_from' => '2020-12-20', 'date_to' => '2020-12-31',]]);

var_dump($response->getStatus(), $response->getData());
```

### Upload files

Use ``\Affise\Sdk\Transport\File`` for each file.

```php
use Affise\Sdk\Transport\File;

$response = $api->offerManaging->addOffer([
    ...
    'creativeFiles' => File::createFromFile('path/to/file'),
    ...
]);

var_dump($response->getStatus(), $response->getData());
```

## List of providers

| Provider      | Api property | Link |
| ----------- | ----------- | ------- |
| ``\Affise\Sdk\Statistics\StatisticsProvider``     |    ``$api->statistics``    | https://api.affise.com/docs3.1/#statistics |
| ``\Affise\Sdk\AffiliateMethods\AffiliateMethodsProvider``     |    ``$api->affiliateMethods``    | https://api.affise.com/docs3.1/#affiliate-methods |
| ``\Affise\Sdk\Offers\OffersProvider``     |    ``$api->offers``    | https://api.affise.com/docs3.1/#offers |
| ``\Affise\Sdk\Advertiser\AdvertiserProvider``     |    ``$api->advertisers``    | https://api.affise.com/docs3.1/#advertiser-managing-admin-methods |
| ``\Affise\Sdk\AdvertiserBilling\AdvertiserBillingProvider``     |    ``$api->advertiserBilling``    | https://api.affise.com/docs3.1/#advertiser-billing-managing-admin-methods |
| ``\Affise\Sdk\OfferManaging\OfferManagingProvider``     |    ``$api->offerManaging``    | https://api.affise.com/docs3.1/#offer-managing-admin-methods |
| ``\Affise\Sdk\Affiliate\AffiliateProvider``     |    ``$api->affiliates``    | https://api.affise.com/docs3.1/#affiliate-managing-admin-methods |
| ``\Affise\Sdk\User\UserProvider``     |    ``$api->users``    | https://api.affise.com/docs3.1/#user-managing-admin-methods |
| ``\Affise\Sdk\ConversionsManaging\ConversionsManagingProvider``     |    ``$api->conversions``    | https://api.affise.com/docs3.1/#conversions-managing |
| ``\Affise\Sdk\OtherManaging\OtherManagingProvider``     |    ``$api->otherManaging``    | https://api.affise.com/docs3.1/#other-managing-admin-methods |
| ``\Affise\Sdk\Presets\PresetsProvider``     |    ``$api->presets``    | https://api.affise.com/docs3.1/#presets-admin-methods |
| ``\Affise\Sdk\Other\OtherProvider``     |    ``$api->other``    | https://api.affise.com/docs3.1/#other-managing |

## Advanced

### Providers

Each provider is a set of grouped endpoints.

```php
use Affise\Sdk\Transport\GuzzleTransport;
use Affise\Sdk\Affiliate\AffiliateProvider;
use Affise\Sdk\User\UserProvider;

require_once __DIR__ . '/vendor/autoload.php';

$transport = new GuzzleTransport('https://YOUR_API_DOMAIN', 'YOUR_API_KEY');
$userProvider = new UserProvider($transport);
$affiliateProvider = new AffiliateProvider($transport);

$response = $userProvider->usersList(['limit' => 10]);

var_dump($response->getStatus(), $response->getData());

$response = $affiliateProvider->affiliateList(['limit' => 10, 'page' => 5]);

var_dump($response->getStatus(), $response->getData(), $response->getPagination()->getPage());
```

### Transport layer

Transport is an abstraction layer over HTTP clients.

```php
use Affise\Sdk\Transport\GuzzleTransport;
use Affise\Sdk\Transport\PsrTransport;
use GuzzleHttp\Client;

require_once __DIR__ . '/vendor/autoload.php';

$transport = new GuzzleTransport('https://YOUR_API_DOMAIN', 'YOUR_API_KEY');

// Or you can use psr adapter
$transport = new PsrTransport(
    new Http\Factory\Guzzle\RequestFactory(),
    new Http\Factory\Guzzle\UriFactory(),
    new Http\Factory\Guzzle\StreamFactory(),
    new Client(),
    'https://YOUR_API_DOMAIN',
    'YOUR_API_KEY'
);

$raw = $transport->get('/3.0/admin/users', ['limit' => 10]);

var_dump($raw);

$raw = $transport->post('/3.0/admin/user/api_key/594927bd7e28fe1c4a8b4568');

var_dump($raw);
```

You can create your own transport. Just implement ``Affise\Sdk\Transport\TransportInterface``.

### Customize api transport

```php
use Affise\Sdk\Api;
use Affise\Sdk\Transport\GuzzleTransport;

require_once __DIR__ . '/vendor/autoload.php';

$api = new Api(new GuzzleTransport('https://YOUR_API_DOMAIN', 'YOUR_API_KEY'));
```

## Test

```bash
./vendor/bin/phpunit tests
```

## License

The MIT license. Read [LICENSE file](https://github.com/affise/php-sdk/blob/master/LICENSE).
