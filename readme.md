# 🌍 Help restore the planet using the Ecologi API

[![tests](https://github.com/sander3/laravel-ecologi/workflows/Laravel/badge.svg)](https://github.com/sander3/laravel-ecologi/actions?query=workflow%3ALaravel)

## Requirements

- PHP >= 8.0
- Laravel >= 8.0

## Installation

First, install the package via the Composer package manager:

```bash
$ composer require soved/laravel-ecologi
```

After installing the package, you should publish the configuration file:

```bash
$ php artisan vendor:publish --tag=ecologi-config
```

## Configuration

Create a [business](https://ecologi.com/business/checkout) or [impact-only](https://ecologi.com/pay-as-you-go) account. Obtain a API token [here](https://ecologi.com/account/api). Add the API token to your environment variables:

```
ECOLOGI_TOKEN=91757e14-3772-41a1-8020-cf434805b64e
```

## Usage

### Track your impact

```php
<?php

use Soved\Laravel\Ecologi\Contracts\EcologiContract;

$ecologi = $this->app->make(EcologiContract::class);

$impact = $ecologi->getImpact('sander');

// ['trees' => 29, 'carbonOffset' => 16.883]

$treesPlanted = $ecologi->getTrees('sander');

// 29

$carbonOffset = $ecologi->getCarbonOffset('sander');

// 16.883

```

### 🌳 Purchase trees or carbon offset

```php
<?php

use Soved\Laravel\Ecologi\Contracts\EcologiContract;

$ecologi = $this->app->make(EcologiContract::class);

$ecologi->purchaseTrees(5);

$ecologi->purchaseCarbonOffset(1, 'Tonnes');

```

You could also schedule one of the following jobs: `PurchaseATree`, `PurchaseCarbonOffset(quantity: 1000, 'KG')` or `PurchaseTrees(quantity: 5)`

```php
<?php

// App\Console\Kernel:

use Illuminate\Console\Scheduling\Schedule;
use Soved\Laravel\Ecologi\Jobs\PurchaseATree;

protected function schedule(Schedule $schedule)
{
    $schedule->job(new PurchaseATree)->daily();
}

```

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Sander de Vos via [sander@tutanota.de](mailto:sander@tutanota.de). All security vulnerabilities will be promptly addressed.
