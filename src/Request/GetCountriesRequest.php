<?php

namespace VasilDakov\Shipping\Request;

readonly class GetCountriesRequest
{
    public function __construct(public ?string $name = null)
    {
    }
}
