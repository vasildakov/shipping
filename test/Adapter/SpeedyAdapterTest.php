<?php

namespace VasilDakov\ShippingTest\Adapter;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Adapter\SpeedyAdapter;

final class SpeedyAdapterTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function itCanBeConstructedWithoutArguments(): void
    {
        $adapter = new SpeedyAdapter();

        self::assertInstanceOf(SpeedyAdapter::class, $adapter);
    }

    /**
     * @test
     */
    public function itCanReturnName(): void
    {
        $adapter = new SpeedyAdapter();

        self::assertEquals('Speedy', $adapter->getName());
    }
}