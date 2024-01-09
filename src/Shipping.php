<?php

declare(strict_types=1);

namespace VasilDakov\Shipping;

use VasilDakov\Shipping\Adapter\AdapterInterface;
use VasilDakov\Shipping\Exception\RuntimeException;

/**
 * Class Shipping
 *
 * @author    Vasil Dakov <vasildakov@gmail.com>
 * @copyright 2009-2024 Neutrino.bg
 * @version   1.0
 */
final class Shipping implements ShippingInterface
{
    public static function create(string $name): AdapterInterface
    {
        $class = Shipping::getClassName($name);
        if (! Shipping::canCreate($class)) {
            // throw new RuntimeException("Class '$class' not found");
            throw new RuntimeException("Invalid or non existing adapter");
        }

        // this should be an adapter instance
        return new $class();
    }

    private static function canCreate(string $name): bool
    {
        if (! class_exists($name)) {
            return false;
        }

        if (! is_subclass_of($name, AdapterInterface::class, true)) {
            return false;
        }

        return true;
    }

    private static function getClassName(string $name): string
    {
        if (0 === strpos($name, '\\') || 0 === strpos($name, 'VasilDakov\\Shipping\\Adapter\\')) {
            return $name;
        }

        return '\\VasilDakov\\Shipping\\Adapter\\' . $name . 'Adapter';
    }
}
