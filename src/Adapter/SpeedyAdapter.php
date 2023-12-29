<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Adapter;

use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use Selective\Transformer\ArrayTransformer;
use VasilDakov\Shipping\Model\Country;
use VasilDakov\Shipping\Request\GetCountriesRequest;
use VasilDakov\Speedy\Configuration;
use VasilDakov\Speedy\Service\Location\Country\FindCountryRequest;
use VasilDakov\Speedy\Service\Location\Site\FindSiteRequest;
use VasilDakov\Speedy\Speedy;
use GuzzleHttp\Client;
use Laminas\Diactoros\RequestFactory;
use VasilDakov\Shipping\Response;
use VasilDakov\Shipping\Request;


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
                    username: $_ENV['SPEEDY_USERNAME'],
                    password: $_ENV['SPEEDY_PASSWORD'],
                    language: $_ENV['SPEEDY_LANGUAGE']
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

    public function getCountries(Request\GetCountriesRequest $request): Response\GetCountriesResponse
    {
        $json = $this->client->findCountry(
            new FindCountryRequest(name: $request->name)
        );
        $data = json_decode($json, true);

        $transformer = new ArrayTransformer();
        $transformer
            ->map('id', 'id')
            ->map('name', 'name')
            ->map('nameEn', 'nameEn')
            ->map('isoAlpha2', 'isoAlpha2')
            ->map('isoAlpha3', 'isoAlpha3')
        ;

        $result = [];
        foreach ($data['countries'] as $country) {
            $result['countries'][] = $transformer->toArray($country);
        }

        $strategy = new \Laminas\Hydrator\Strategy\CollectionStrategy(
            new \Laminas\Hydrator\ObjectPropertyHydrator(),
            Country::class
        );
        $array = $strategy->hydrate($result['countries']);

        return new Response\GetCountriesResponse($array);

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
