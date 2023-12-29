<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Adapter;

use VasilDakov\Shipping\Request;
use VasilDakov\Shipping\Response;

interface AdapterInterface
{
    public function getName(): string;

    public function getCountries(Request\GetCountriesRequest $request): Response\GetCountriesResponse;

    public function getCities(array $data);

    public function getOffices(array $data);

    public function track(array $data);
}
