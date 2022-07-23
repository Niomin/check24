<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchList;

use DateTimeImmutable;

final class ArticleListRequest
{
    public function __construct(
        private readonly DateTimeImmutable $lastCreatedAt,
        private readonly int               $lastId
    ) {
    }

    public function getLastCreatedAt(): DateTimeImmutable
    {
        return $this->lastCreatedAt;
    }

    public function getLastId(): int
    {
        return $this->lastId;
    }
}
