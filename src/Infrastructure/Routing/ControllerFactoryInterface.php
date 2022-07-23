<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

interface ControllerFactoryInterface
{
    public function canProcess(string $path, ?string $query): bool;

    public function create(): ControllerInterface;
}
