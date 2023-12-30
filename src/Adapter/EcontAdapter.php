<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Adapter;

use GuzzleHttp\Client;
use Laminas\Diactoros\RequestFactory;
use Psr\Http\Client\ClientExceptionInterface;
use VasilDakov\Econt\Configuration;
use VasilDakov\Econt\Econt;
use VasilDakov\Econt\EcontInterface;
use VasilDakov\Econt\Request\GetCitiesRequest;
use VasilDakov\Shipping\Model\City;
use VasilDakov\Shipping\Model\Country;
use VasilDakov\Shipping\Request;
use VasilDakov\Shipping\Response;
use Selective\Transformer\ArrayTransformer;

use function array_filter;
use function str_starts_with;

class EcontAdapter implements AdapterInterface
{
    private const NAME = 'Econt';

    private ?EcontInterface $client;

    public function __construct(?EcontInterface $client = null)
    {
        if (! $client) {
            $configuration = new Configuration(
                username: $_ENV['ECONT_USERNAME'],
                password: $_ENV['ECONT_PASSWORD'],
            );

            $client = new Econt(
                $configuration,
                new Client(
                    [
                        'connect_timeout' => 5,
                        'read_timeout' => 10,
                        'verify' => false,
                    ]
                ),
                new RequestFactory()
            );
        }

        $this->client = $client;
    }


    private function jsonDecode(string $json): array
    {
        return json_decode($json, true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function getClientProfiles(): string
    {
        return $this->client->getClientProfiles();
    }


    /**
     * @param Request\GetCountriesRequest $request
     * @return Response\GetCountriesResponse
     * @throws ClientExceptionInterface
     */
    public function getCountries(Request\GetCountriesRequest $request): Response\GetCountriesResponse
    {
        $json = $this->client->getCountries();
        $data = $this->jsonDecode($json);

        // transform properties to Shipping Model
        $transformer = new ArrayTransformer();
        $transformer
            ->map('id', 'id')
            ->map('name', 'name')
            ->map('nameEn', 'nameEn')
            ->map('isoAlpha2', 'code2')
            ->map('isoAlpha3', 'code3')
        ;
        $result = [];
        foreach ($data['countries'] as $country) {
            $result['countries'][] = $transformer->toArray($country);
        }

        // $hydrator = new \Laminas\Hydrator\ClassMethodsHydrator();
        // $hydrator = new \Laminas\Hydrator\ObjectPropertyHydrator();
        // $hydrator = new \Laminas\Hydrator\ReflectionHydrator();

        $strategy = new \Laminas\Hydrator\Strategy\CollectionStrategy(
            new \Laminas\Hydrator\ObjectPropertyHydrator(),
            Country::class
        );
        $array = $strategy->hydrate($result['countries']);

        // implementing missing econt non-strict country search
        if (null !== $request->name) {
            $array = array_filter($array, function (Country $country) use ($request) {
                return
                    str_starts_with($country->name, $request->name) ||
                    str_starts_with($country->nameEn, $request->name)
                ;
            });
        }

        return new Response\GetCountriesResponse($array);
    }


    /**
     * @param Request\GetCitiesRequest $request
     * @return Response\GetCitiesResponse
     * @throws ClientExceptionInterface
     */
    public function getCities(Request\GetCitiesRequest $request): Response\GetCitiesResponse
    {
        $json = $this->client->getCities(new GetCitiesRequest(countryCode: $request->isoAlpha3));

        $data = $this->jsonDecode($json);

        // transform properties to Shipping Model
        $transformer = new ArrayTransformer();
        $transformer
            ->map('id', 'id')
            ->map('country', 'country')
            ->map('postCode', 'postCode')
            ->map('name', 'name')
            ->map('nameEn', 'nameEn')
        ;
        $result = [];
        foreach ($data['cities'] as $country) {
            $result['cities'][] = $transformer->toArray($country);
        }

        $hydrator = new \Laminas\Hydrator\ObjectPropertyHydrator();
        $strategy = new \Laminas\Hydrator\Strategy\CollectionStrategy(
            $hydrator,
            City::class
        );
        $hydrator->addStrategy(
            'country',
            new \Laminas\Hydrator\Strategy\HydratorStrategy(
                new \Laminas\Hydrator\ReflectionHydrator(),
                Country::class
            )
        );

        $array = $strategy->hydrate($result['cities']);

        if (null !== $request->name) {
            $array = array_filter($array, function (City $city) use ($request) {
                return
                    str_starts_with($city->name, $request->name) ||
                    str_starts_with($city->nameEn, $request->name)
                    ;
            });
        }

        return new Response\GetCitiesResponse($array);
    }

    /**
     */
    public function getOffices(array $data): string
    {
        return $this->client->getOffices($data);
    }

    public function calculate()
    {
        return $this->client->calculate();
    }

    public function track(array $data)
    {
        return $this->client->getShipmentStatuses($data);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
