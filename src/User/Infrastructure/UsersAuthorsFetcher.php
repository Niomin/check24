<?php

declare(strict_types=1);

namespace Check24\Assignment\User\Infrastructure;

use Check24\Assignment\Infrastructure\Database\Connection;
use Check24\Assignment\User\Query\FetchAuthors\UserAuthorViewModel;
use Check24\Assignment\User\Query\FetchAuthors\UserAuthorViewModelCollection;
use Check24\Assignment\User\Query\FetchAuthors\UsersAuthorsFetcherInterface;

use function array_map;

final class UsersAuthorsFetcher implements UsersAuthorsFetcherInterface
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function fetchAuthors(): UserAuthorViewModelCollection
    {
        //if we have a lot of users, we should add denormalized field to user to make this query simple.
        $sql = <<<sql
SELECT u.id, u.name FROM users u
WHERE EXISTS(SELECT id FROM articles a WHERE a.author_id = u.id)
ORDER BY id
sql;

        return new UserAuthorViewModelCollection(
            array_map(
                fn(array $rawUser) => $this->hydrateUser($rawUser),
                $this->connection->fetchAll($sql, [])
            )
        );
    }

    /** @param mixed[] $rawUser  */
    private function hydrateUser(array $rawUser): UserAuthorViewModel
    {
        return new UserAuthorViewModel($rawUser['id'], $rawUser['name']);
    }
}
