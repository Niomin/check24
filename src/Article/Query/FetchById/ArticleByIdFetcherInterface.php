<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchById;

interface ArticleByIdFetcherInterface
{
    public function fetch(int $id): ?ArticleByIdViewModel;
}
