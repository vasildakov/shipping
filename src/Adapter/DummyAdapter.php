<?php

namespace VasilDakov\Shipping\Adapter;

use VasilDakov\Shipping\Response;

class DummyAdapter implements AdapterInterface
{
    private const NAME = 'Econt';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getCountries(): Response\GetCountriesResponse
    {
        // TODO: Implement getCountries() method.
    }

    public function getCities(array $data)
    {
        // TODO: Implement getCities() method.
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