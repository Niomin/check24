<?php

declare(strict_types=1);

namespace Check24\Assignment\Comment\Query\FetchByArticle;

final class CommentsByArticleQuery
{
    public function __construct(
        private readonly CommentsByArticleFetcherInterface $fetcher
    ) {
    }

    public function getByArticle(int $articleId): CommentByArticleViewModelCollection
    {
        return $this->fetcher->fetchByArticle($articleId);
    }
}
