<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

enum HttpCode
{
    case HTTP_OK;
    case HTTP_BAD_REQUEST;
    case HTTP_NOT_FOUND;

    public function getCode(): int
    {
        return match ($this) {
            self::HTTP_OK          => 200,
            self::HTTP_BAD_REQUEST => 400,
            self::HTTP_NOT_FOUND   => 404,
        };
    }
}
