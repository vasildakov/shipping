<?php

namespace VasilDakov\Shipping\Response;

use VasilDakov\Shipping\Collection\ArrayCollection;

class GetCitiesResponse
{
    public ArrayCollection $cities;

    public function __construct(array $records = [])
    {
        $this->cities = new ArrayCollection($records);
    }
}
