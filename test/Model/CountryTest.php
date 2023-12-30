<?php

namespace VasilDakov\ShippingTest;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Model\Country;

final class CountryTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructedWithoutArguments(): void
    {
        self::assertInstanceOf(Country::class, new Country());
    }
}
