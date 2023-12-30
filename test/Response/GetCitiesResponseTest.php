<?php

namespace VasilDakov\ShippingTest\Response;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Response\GetCitiesResponse;

final class GetCitiesResponseTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        self::assertInstanceOf(GetCitiesResponse::class, new GetCitiesResponse());
    }
}
