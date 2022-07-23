<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

interface ControllerFactoryInterface
{
    /**
     * FIXME here is config duplication: inside controller and inside controllerFactory
     * @param mixed[] $parsedQuery
     */
    public function canProcess(string $path, array $parsedQuery): bool;

    public function create(): ControllerInterface;
}
