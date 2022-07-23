<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

final class RouterFactory
{
    /** @var ControllerFactoryInterface[] */
    private array $factories = [];

    public function registerControllerFactory(ControllerFactoryInterface $factory): void
    {
        $this->factories[] = $factory;
    }

    public function createRouter(): Router
    {
        return new Router(
            new JsonFormatter(),
            $this->factories
        );
    }
}
