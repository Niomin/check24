<?php

declare(strict_types=1);

namespace Check24\Assignment\Presentation\Controller;

use Check24\Assignment\Infrastructure\Routing\ControllerInterface;
use Check24\Assignment\Infrastructure\Routing\Exception\HttpNotFoundException;

final class HealthCheckController implements ControllerInterface
{
    /**
     * @return array{'ok': bool}
     */
    public function process(string $path, ?string $query): array
    {
        if ('/' === $path) {
            return [
                'ok' => true,
            ];
        }

        throw new HttpNotFoundException();
    }
}
