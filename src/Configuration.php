<?php

declare(strict_types=1);

namespace Shipping;

readonly class Configuration implements ConfigurationInterface
{
    public function __construct(
        public string $username,
        public string $password,
    ) {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
