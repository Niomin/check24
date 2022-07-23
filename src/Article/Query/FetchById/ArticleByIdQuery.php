<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchById;

use Check24\Assignment\Post\Infrastructure\Database\ArticleByIdFetcher;

final class ArticleByIdQuery
{
    public function __construct(
        private readonly ArticleByIdFetcherInterface $fetcher
    ) {
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function getById(int $id): ArticleByIdViewModel
    {
        $viewModel = $this->fetcher->fetch($id);
        if (null === $viewModel) {
            throw new ArticleNotFoundException();
        }

        return $viewModel;
    }
}
