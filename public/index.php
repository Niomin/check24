<?php

use Check24\Assignment\Infrastructure\Routing\RouterFactory;
use Check24\Assignment\Presentation\ControllerFactory\HealthCheckControllerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$requestUri = $_SERVER['REQUEST_URI'];

ob_start();
$routerFactory = new RouterFactory();
$routerFactory->registerControllerFactory(new HealthCheckControllerFactory());
$router = $routerFactory->createRouter();
$router->dispatch($requestUri);
ob_end_flush();