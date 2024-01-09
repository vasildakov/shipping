<?php

namespace VasilDakov\Shipping\Response;

use VasilDakov\Shipping\Collection\ArrayCollection;

class GetOfficesResponse
{
    public ArrayCollection $offices;

    public function __construct(array $records = [])
    {
        $this->offices = new ArrayCollection($records);
    }
}
