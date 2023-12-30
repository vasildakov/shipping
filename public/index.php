<?php

use VasilDakov\Shipping\Request\GetCitiesRequest;
use VasilDakov\Shipping\Request\GetCountriesRequest;
use VasilDakov\Shipping\Shipping;

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (is_string($path) && __FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable('./');
$dotenv->load();
$dotenv->required([
    'ECONT_USERNAME',
    'ECONT_PASSWORD',
])->notEmpty();


$econt  = Shipping::create('Econt');
$speedy = Shipping::create('Speedy');


// $response = $econt->getCountries(new GetCountriesRequest('Bul'));
$response = $econt->getCities(new GetCitiesRequest('BGR', null, 'Sl'));
//$response = $speedy->getCities(new GetCitiesRequest(100, 'Sl'));

foreach ($response->cities as $city) {
    dump($city); exit();
    //exit();
}

dump($response);
