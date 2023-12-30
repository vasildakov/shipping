<?php

namespace VasilDakov\Shipping\Model;

class City
{
    public function __construct(
        public ?int $id = null,
        public ?string $countryId = null,
        public ?Country $country = null,
        public ?string $name = null,
        public ?string $nameEn = null,
        public ?string $postCode = null,
    ) {
    }
}
