<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

final class JsonFormatter implements ResponseFormatterInterface
{
    public function response(mixed $data, HttpCode $httpCode): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpCode->getCode());

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    public function error(string $message, HttpCode $httpCode): void
    {
        $this->response(['error' => $message], $httpCode);
    }
}
