<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchList;

use DateTimeImmutable;

interface ArticleListFetcherInterface
{
    public function fetch(?ArticleListRequest $request): ArticleInListViewModelCollection;
}
