<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Response;

use VasilDakov\Shipping\Collection\ArrayCollection;
use VasilDakov\Shipping\Model\Country;

class GetCountriesResponse
{
    public ArrayCollection $countries;

    public function __construct(array $records = []
        //#[CastListToType(Country::class)]
    ) {
        $this->countries = new ArrayCollection($records);
    }


    public function findByName(string $name): ArrayCollection
    {

        return $this->countries->filter(function (Country $country) use ($name) {
            return $country->name == $name || $country->nameEn == $name;
        });
    }

    public function findByIsoAlpha2(string $isoAlpha2): ArrayCollection
    {

        return $this->countries->filter(function (Country $country) use ($isoAlpha2) {
            return $country->isoAlpha2 == $isoAlpha2;
        });
    }

    public function findByIsoAlpha3(string $isoAlpha3): ArrayCollection
    {

        return $this->countries->filter(function (Country $country) use ($isoAlpha3) {
            return $country->isoAlpha3 == $isoAlpha3;
        });

        // return (!$collection->isEmpty()) ? $collection->first() : null;
    }
}
