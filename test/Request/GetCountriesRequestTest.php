<?php

namespace VasilDakov\ShippingTest\Request;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Request\GetCountriesRequest;

final class GetCountriesRequestTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        self::assertInstanceOf(GetCountriesRequest::class, new GetCountriesRequest());
    }
}
