<?php

declare(strict_types=1);

namespace Check24\Assignment\User\Query\FetchAuthors;

use JsonSerializable;

final class UserAuthorViewModel implements JsonSerializable
{
    public function __construct(
        private readonly int    $id,
        private readonly string $name
    ) {
    }

    /** @return mixed[] */
    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
