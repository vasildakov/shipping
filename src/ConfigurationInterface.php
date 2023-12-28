<?php

namespace Shipping;

interface ConfigurationInterface
{
    public function getUsername(): string;

    public function getPassword(): string;

}