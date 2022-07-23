<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchList;

final class ArticleListQuery
{
    public function __construct(
        private readonly ArticleListFetcherInterface $fetcher
    )
    {
    }

    /**
     * Pagination by createdAt is a better decision than just page number,
     * because new pages can be added while user views old articles.
     * However, different articles can be created in exactly one second,
     * so I implemented an additional sorting by id here.
     */
    public function getList(?ArticleListRequest $request): ArticleInListViewModelCollection
    {
        return $this->fetcher->fetch($request);
    }
}
