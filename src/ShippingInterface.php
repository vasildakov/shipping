<?php

namespace VasilDakov\Shipping;

use VasilDakov\Shipping\Adapter\AdapterInterface;

/**
 * ShippingInterface
 *
 * @author    Vasil Dakov <vasildakov@gmail.com>
 * @copyright 2009-2024 Neutrino.bg
 * @version   1.0
 */
interface ShippingInterface
{
    public static function create(string $name): AdapterInterface;
}
