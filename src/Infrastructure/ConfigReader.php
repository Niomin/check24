<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure;

use Dotenv\Dotenv;
use RuntimeException;

use function getenv;
use function sprintf;

/**
 * todo we should create custom application config, not only read from .env
 */
final class ConfigReader
{
    public function get(string $name, string $default = null): string
    {
        $val = $_ENV[$name] ?? $default;
        if (null === $val) {
            throw new RuntimeException(sprintf('Cannot read config "%s"', $name));
        }

        return $val;
    }
}
