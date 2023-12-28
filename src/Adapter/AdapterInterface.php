<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Adapter;

use VasilDakov\Shipping\Response;

interface AdapterInterface
{
    public function getName(): string;

    public function getCountries(): Response\GetCountriesResponse;

    public function getCities(array $data);

    public function getOffices(array $data);

    public function track(array $data);
}
