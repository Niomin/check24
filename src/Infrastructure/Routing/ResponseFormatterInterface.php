<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

interface ResponseFormatterInterface
{
    /**
     * todo add some exception if data is not processable
     */
    public function response(mixed $data, HttpCode $httpCode): void;

    public function error(string $message, HttpCode $httpCode): void;
}
