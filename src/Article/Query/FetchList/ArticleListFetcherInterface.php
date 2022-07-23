<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchList;

use DateTimeImmutable;

interface ArticleListFetcherInterface
{
    public function fetch(DateTimeImmutable $lastCreatedAt, int $lastId): ArticleInListViewModelCollection;
}
