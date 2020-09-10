<?php

require dirname(__DIR__).'/vendor/autoload.php';

$testsDirectory = dirname(__DIR__).DIRECTORY_SEPARATOR.'tests';

if (file_exists($testsDirectory.DIRECTORY_SEPARATOR.'.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($testsDirectory);
    $dotenv->load();
}
