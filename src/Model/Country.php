<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Model;

use EventSauce\ObjectHydrator;

class Country
{
    public function __construct(
        #[ObjectHydrator\MapFrom('id')]
        public ?int $id = null,

        #[ObjectHydrator\MapFrom('name')]
        public ?string $name = null,

        #[ObjectHydrator\MapFrom('nameEn')]
        public ?string $nameEn = null,

        #[ObjectHydrator\MapFrom('isoAlpha2')]
        public ?string $isoAlpha2 = null,

        #[ObjectHydrator\MapFrom('isoAlpha3')]
        public ?string $isoAlpha3 = null,
    ) {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
