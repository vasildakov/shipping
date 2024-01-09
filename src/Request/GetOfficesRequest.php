<?php

namespace VasilDakov\Shipping\Request;

class GetOfficesRequest
{
    public function __construct(
        public readonly ?int $countryId = null,
        public readonly ?int $cityId = null
    ) {
    }
}
