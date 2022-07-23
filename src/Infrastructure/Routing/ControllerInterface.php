<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

use Check24\Assignment\Infrastructure\Routing\Exception\AbstractHttpException;

interface ControllerInterface
{
    /**
     * @param mixed[] $query
     * @throws AbstractHttpException
     */
    public function process(string $path, array $query): mixed;
}
