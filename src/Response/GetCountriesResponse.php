<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use VasilDakov\Shipping\Model\Country;

final class GetCountriesResponse
{
    private ArrayCollection $countries;

    public function __construct()
    {
        $this->countries = new ArrayCollection();
    }

    public function addCountry(Country $country): void
    {
        $this->countries[] = $country;
    }

    public function getCountries(): Collection
    {
        return $this->countries;
    }
}

