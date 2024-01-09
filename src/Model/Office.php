<?php

namespace VasilDakov\Shipping\Model;

class Office
{
    public function __construct(
        public ?string $name = null,
        public ?string $nameEn = null,
    ) {
    }
}
