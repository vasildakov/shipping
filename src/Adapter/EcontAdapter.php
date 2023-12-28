<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Adapter;

use GuzzleHttp\Client;
use Laminas\Diactoros\RequestFactory;
use Psr\Http\Client\ClientExceptionInterface;
use VasilDakov\Econt\Configuration;
use VasilDakov\Econt\Econt;
use VasilDakov\Shipping\Response;

class EcontAdapter implements AdapterInterface
{
    private const NAME = 'Econt';

    private ?Econt $client;

    public function __construct(?Econt $client = null)
    {
        if (! $client) {
            $configuration = new Configuration(
                'iasp-dev',
                '1Asp-dev'
            );

            $client = new Econt($configuration, new Client(), new RequestFactory());
        }

        $this->client = $client;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function getClientProfiles(): string
    {
        return $this->client->getClientProfiles();
    }


    public function getCountries(): Response\GetCountriesResponse
    {
        $json = $this->client->getCountries();
        return new Response\GetCountriesResponse();
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function getCities(array $data): string
    {
        return $this->client->getCities($data);
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
