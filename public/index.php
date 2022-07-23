<?php

use Check24\Assignment\Infrastructure\Routing\ControllerFactory\ArticleControllerFactory;
use Check24\Assignment\Infrastructure\Routing\ControllerFactory\HealthCheckControllerFactory;
use Check24\Assignment\Infrastructure\Routing\RouterFactory;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$requestUri = $_SERVER['REQUEST_URI'];

ob_start();
$routerFactory = new RouterFactory();
$routerFactory->registerControllerFactory(new HealthCheckControllerFactory());
$routerFactory->registerControllerFactory(new ArticleControllerFactory());
$router = $routerFactory->createRouter();
$router->dispatch($requestUri);
ob_end_flush();