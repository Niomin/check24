<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing;

use Check24\Assignment\Infrastructure\Routing\Exception\AbstractHttpException;

use function explode;
use function sprintf;

/**
 * Here should be only simple config, but not today.
 */
final class Router
{
    /**
     * @param ControllerFactoryInterface[] $controllerFactories
     */
    public function __construct(
        private readonly ResponseFormatterInterface $responseFormatter,
        private readonly array                      $controllerFactories
    ) {
    }

    public function dispatch(string $requestUri): void
    {
        $exploded    = explode('?', $requestUri);
        $path        = $exploded[0];
        $query       = $exploded[1] ?? '';
        $parsedQuery = $this->parseQuery($query);

        foreach ($this->controllerFactories as $controllerFactory) {
            if ($controllerFactory->canProcess($path, $parsedQuery)) {
                $controller = $controllerFactory->create();
                try {
                    $data = $controller->process($path, $parsedQuery);
                    $code = HttpCode::HTTP_OK;
                } catch (AbstractHttpException $e) {
                    $data = [
                        'message' => $e->getMessage(),
                    ];
                    $code = $e->getHttpCode();
                }

                $this->responseFormatter->response($data, $code);

                return;
            }
        }

        $this->responseFormatter->error(sprintf('Path "%s" not found', $path), HttpCode::HTTP_NOT_FOUND);
    }

    private function parseQuery(string $query): array
    {
        $parsedQuery = [];
        parse_str($query, $parsedQuery);

        return $parsedQuery;
    }
}
