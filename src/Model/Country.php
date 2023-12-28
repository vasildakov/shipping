<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Model;

final readonly class Country
{
    public function __construct(
        public int $id
    ) {
    }
}
