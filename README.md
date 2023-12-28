# Shipping


## Features

This library is compliant with [PSR-7: HTTP message interfaces](https://www.php-fig.org/psr/psr-7/), [PSR-17: HTTP Factories](https://www.php-fig.org/psr/psr-17/) and [PSR-18: HTTP Client](https://www.php-fig.org/psr/psr-18/)


## Installation

Using Composer:

```
$ composer require vasildakov/shipping
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