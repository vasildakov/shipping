<?php

namespace VasilDakov\Shipping\Request;

class GetCitiesRequest
{
    public function __construct(
        public string|null $isoAlpha3 = null,
        public string|int|null $countryId = null,
        public string|null $name = null
    ) {
    }
}
