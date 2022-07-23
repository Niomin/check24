<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing\ControllerFactory;

use Check24\Assignment\Infrastructure\Database\ConnectionFactory;
use Check24\Assignment\Infrastructure\Routing\ControllerFactoryInterface;
use Check24\Assignment\Presentation\Controller\UserController;
use Check24\Assignment\User\Infrastructure\UsersAuthorsFetcher;
use Check24\Assignment\User\Query\FetchAuthors\UsersAuthorsQuery;

use function count;

final class UserControllerFactory implements ControllerFactoryInterface
{
    public function create(): UserController
    {
        $connection = (new ConnectionFactory())->create();

        return new UserController(
            new UsersAuthorsQuery(
                new UsersAuthorsFetcher(
                    $connection
                )
            )
        );
    }

    public function canProcess(string $path, array $parsedQuery): bool
    {
        $exploded = explode('/', $path);

        return count($exploded) >= 1 && $exploded[1] === 'users';
    }
}
