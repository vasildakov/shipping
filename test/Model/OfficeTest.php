<?php

namespace VasilDakov\ShippingTest;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Model\Office;

final class OfficeTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructedWithoutArguments(): void
    {
        self::assertInstanceOf(Office::class, new Office());
    }
}
