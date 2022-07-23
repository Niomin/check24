<?php

declare(strict_types=1);

namespace Check24\Assignment\Presentation\ControllerFactory;

use Check24\Assignment\Infrastructure\Routing\ControllerFactoryInterface;
use Check24\Assignment\Presentation\Controller\HealthCheckController;

final class HealthCheckControllerFactory implements ControllerFactoryInterface
{
    public function create(): HealthCheckController
    {
        return new HealthCheckController();
    }

    public function canProcess(string $path, ?string $query): bool
    {
        return '/' === $path;
    }
}
