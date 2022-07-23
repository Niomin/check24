<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing\Exception;

use Check24\Assignment\Infrastructure\Routing\HttpCode;
use Exception;
use RuntimeException;
use Throwable;

/**
 * RuntimeException to hide IDE unhandled exceptions warning
 */
abstract class AbstractHttpException extends RuntimeException
{

    public function __construct(
        private readonly HttpCode $httpCode,
        string                    $message = '',
        ?Throwable                $previous = null
    ) {
        parent::__construct($message, $httpCode->getCode(), $previous);
    }

    public function getHttpCode(): HttpCode
    {
        return $this->httpCode;
    }
}
