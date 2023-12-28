<?php

declare(strict_types=1);

namespace VasilDakov\ShippingTest;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Shipping;
use VasilDakov\Shipping\ShippingInterface;

final class ShippingTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeInstantiated(): void
    {
        self::assertInstanceOf(ShippingInterface::class, new Shipping());
    }
}
