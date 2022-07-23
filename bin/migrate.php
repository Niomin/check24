#!/usr/bin/env php
<?php

//TODO here should be fancy migrations mechanism
// at least we have to store last applied migration

use Check24\Assignment\Infrastructure\Database\ConnectionFactory;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$dirName = __DIR__ . '/../migrations';
$files = scandir($dirName);
if (false === $files) {
    exit('Cannot scan current dir');
}

$queries = [];

foreach ($files as $fileName) {
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    if ('sql' !== $extension) {
        continue;
    }
    $query = file_get_contents($dirName . '/' . $fileName);
    if (false === $query) {
        exit(sprintf('Cannot read "%s"', $dirName . '/' . $fileName));
    }
    $queries[] = $query;
}

if ([] === $queries) {
    exit('No migrations!');
}

$connection = (new ConnectionFactory())->create();
$connection->transactional(function() use ($connection, $queries) {
    //fixme it's to be able rerun migrations. We shouldn't ruin the database on every migration!
    $connection->execute('DROP SCHEMA public CASCADE; CREATE SCHEMA public');
    foreach ($queries as $query) {
        $connection->execute($query);
    }
});