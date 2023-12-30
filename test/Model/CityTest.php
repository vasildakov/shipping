<?php

namespace VasilDakov\ShippingTest;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Model\City;

final class CityTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructedWithoutArguments(): void
    {
        self::assertInstanceOf(City::class, new City());
    }
}
