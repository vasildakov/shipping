# Shipping

![example workflow](https://github.com/vasildakov/shipping/actions/workflows/php.yml/badge.svg)

## Features

This library is compliant with [PSR-7: HTTP message interfaces](https://www.php-fig.org/psr/psr-7/), [PSR-17: HTTP Factories](https://www.php-fig.org/psr/psr-17/) and [PSR-18: HTTP Client](https://www.php-fig.org/psr/psr-18/)


## Installation

Using Composer:

```
$ composer require vasildakov/shipping
```

## Configuration

...

Add your adapters configuration to a .env file in the root of your project. Make sure the .env file is added to your .gitignore so it is not checked-in the code
```dotenv
SPEEDY_USERNAME="username"
SPEEDY_PASSWORD="password"
SPEEDY_LANGUAGE="EN"

ECONT_USERNAME="username"
ECONT_PASSWORD="password"
```


## Usage

```php
<?php

use VasilDakov\Shipping\Shipping;
use VasilDakov\Shipping\Adapter\EcontAdapter;
use VasilDakov\Shipping\Adapter\SpeedyAdapter;

// using strings
$econt  = Shipping::create('Econt');
$speedy = Shipping::create('Speedy');


// ... or using class name
$econt  = Shipping::create(EcontAdapter::class);
$speedy = Shipping::create(SpeedyAdapter::class);
```

## Services

### 1 Countries

```php 
<?php

$econt  = Shipping::create('Econt');

$request = new GetCountriesRequest(name: 'Bul');

/** @var GetCountriesResponse $response */
$response = $econt->getCountries();

foreach ($response->countries as $country) {
    dump($country);
}
```

### 2 Cities

```php 
<?php
$econt  = Shipping::create('Econt');

$request = new GetCitiesRequest(isoAlpha3: 'BGR');

/** @var GetCitiesResponse $response */
$response = $econt->getCities($request);

foreach ($response->cities as $city) {
    dump($city);
}

```


## License

Code released under [the MIT license](https://github.com/vasildakov/shipping/blob/main/LICENSE)