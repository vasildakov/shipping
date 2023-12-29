<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Model;

use EventSauce\ObjectHydrator;

class Country
{
    public function __construct(
        #[ObjectHydrator\MapFrom('id')]
        public ?int $id,

        #[ObjectHydrator\MapFrom('name')]
        public ?string $name,

        #[ObjectHydrator\MapFrom('nameEn')]
        public ?string $nameEn,

        #[ObjectHydrator\MapFrom('isoAlpha2')]
        public ?string $isoAlpha2,

        #[ObjectHydrator\MapFrom('isoAlpha3')]
        public ?string $isoAlpha3,
    ) {
    }
}
