<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

interface ControllerFactoryInterface
{
    /**
     * FIXME here is config duplication: inside controller and inside controllerFactory
     */
    public function canProcess(string $path, ?string $query): bool;

    public function create(): ControllerInterface;
}
