<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing\Exception;

use Check24\Assignment\Infrastructure\Routing\HttpCode;
use Throwable;

final class HttpBadRequestException extends AbstractHttpException
{
    public function __construct(string $message = '', ?Throwable $previous = null)
    {
        parent::__construct(HttpCode::HTTP_BAD_REQUEST, $message, $previous);
    }
}
