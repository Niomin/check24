<?php

declare(strict_types=1);

namespace Check24\Assignment\User\Query\FetchAuthors;

final class UsersAuthorsQuery
{
    public function __construct(
        private readonly UsersAuthorsFetcherInterface $fetcher
    ) {
    }

    public function getAuthors(): UserAuthorViewModelCollection
    {
        return $this->fetcher->fetchAuthors();
    }
}
