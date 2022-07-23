<?php

declare(strict_types=1);

namespace Check24\Assignment\Presentation\Controller;

use Check24\Assignment\Infrastructure\Routing\ControllerInterface;
use Check24\Assignment\Infrastructure\Routing\Exception\AbstractHttpException;
use Check24\Assignment\Infrastructure\Routing\Exception\HttpNotFoundException;
use Check24\Assignment\User\Query\FetchAuthors\UserAuthorViewModelCollection;
use Check24\Assignment\User\Query\FetchAuthors\UsersAuthorsQuery;

final class UserController implements ControllerInterface
{
    public function __construct(private readonly UsersAuthorsQuery $authorsQuery)
    {
    }

    public function process(string $path, array $query): mixed
    {
        if ($path === '/users/authors') {
            return $this->getAuthors();
        }

        throw new HttpNotFoundException();
    }

    private function getAuthors(): UserAuthorViewModelCollection
    {
        return $this->authorsQuery->getAuthors();
    }
}
