<?php

declare(strict_types=1);

namespace VasilDakov\Shipping\Model;

final readonly class Country
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $nameEn,
        public ?string $isoAlpha2,
        public ?string $isoAlpha3,
    ) {
    }
}
