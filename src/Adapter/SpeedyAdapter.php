<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Adapter;

use VasilDakov\Speedy\Configuration;
use VasilDakov\Speedy\Service\Location\Country\FindCountryRequest;
use VasilDakov\Speedy\Service\Location\Site\FindSiteRequest;
use VasilDakov\Speedy\Speedy;
use GuzzleHttp\Client;
use Laminas\Diactoros\RequestFactory;

/**
 * SpeedyAdapter
 *
 * @author    Vasil Dakov <vasildakov@gmail.com>
 * @copyright 2009-2024 Neutrino.bg
 * @version   1.0
 */
final class SpeedyAdapter implements AdapterInterface
{
    private const NAME = 'Speedy';

    private ?Speedy $client;

    public function __construct(?Speedy $client = null)
    {
        if (null === $client) {
            $client = new Speedy(
                new Configuration(
                    username: '1995693',
                    password: '9641464698',
                    language: 'EN'
                ),
                new Client(),
                new RequestFactory()
            );
        }
        $this->client = $client;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getCountries(array $data)
    {
        $object = new FindCountryRequest($data['name']);
        return $this->client->findCountry($object);
    }

    public function getCities(array $data)
    {
        $object = new FindSiteRequest(
            countryId: $data['countryId'],
            name: $data['name']
        );
        return $this->client->findSite($object);
    }

    public function getOffices(array $data)
    {
        // TODO: Implement getOffices() method.
    }

    public function track(array $data)
    {
        // TODO: Implement track() method.
    }
}
