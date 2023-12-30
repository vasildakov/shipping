<?php

namespace VasilDakov\ShippingTest\Request;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Request\GetCitiesRequest;

final class GetCitiesRequestTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        self::assertInstanceOf(GetCitiesRequest::class, new GetCitiesRequest());
    }
}
