<?php

declare(strict_types=1);

namespace VasilDakov\ShippingTest;

use PHPUnit\Framework\TestCase;
use Shipping\Configuration;

final class ConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        $configuration = new Configuration('username', 'password');

        self::assertInstanceOf(Configuration::class, $configuration);

        self::assertEquals('username', $configuration->getUsername());

        self::assertEquals('password', $configuration->getPassword());
    }
}
