<?php

declare(strict_types=1);

namespace VasilDakov\ShippingTest;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Adapter\BadAdapter;
use VasilDakov\Shipping\Adapter\EcontAdapter;
use VasilDakov\Shipping\Adapter\SpeedyAdapter;
use VasilDakov\Shipping\Exception\RuntimeException;
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

    /**
     * @test
     */
    public function itCanCreateAdapterByName(): void
    {
        $speedy = Shipping::create('Speedy');
        $econt = Shipping::create('Econt');

        self::assertInstanceOf(SpeedyAdapter::class, $speedy);
        self::assertInstanceOf(EcontAdapter::class, $econt);
    }

    /**
     * @test
     */
    public function itCanCreateAdapterByClassName(): void
    {
        $speedy = Shipping::create(SpeedyAdapter::class);
        $econt = Shipping::create(EcontAdapter::class);

        self::assertInstanceOf(SpeedyAdapter::class, $speedy);
        self::assertInstanceOf(EcontAdapter::class, $econt);
    }

    /**
     * @test
     */
    public function itWillThrowAnExceptionForNonExistingAdapter(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Invalid or non existing adapter');

        Shipping::create('Bar');
    }

    /**
     * @test
     */
    public function itWillThrowAnExceptionForNotImplementingAdapterInterface(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Invalid or non existing adapter');

        Shipping::create(BadAdapter::class);
    }
}
