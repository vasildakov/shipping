<?php

chdir(dirname(__DIR__));

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable('./', '.env.dist');
$dotenv->load();
