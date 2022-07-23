<?php

declare(strict_types=1);

namespace Check24\Assignment\User\Query\FetchAuthors;

use JsonSerializable;

final class UserAuthorViewModelCollection implements JsonSerializable
{
    /** @param UserAuthorViewModel[] $userAuthors */
    public function __construct(
        private readonly array $userAuthors
    ) {
    }

    /** @return mixed[] */
    public function jsonSerialize(): array
    {
        return [
            'authors' => $this->userAuthors,
        ];
    }
}
