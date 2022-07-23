<?php

declare(strict_types=1);

namespace Check24\Assignment\User\Query\FetchAuthors;

interface UsersAuthorsFetcherInterface
{
    public function fetchAuthors(): UserAuthorViewModelCollection;
}
