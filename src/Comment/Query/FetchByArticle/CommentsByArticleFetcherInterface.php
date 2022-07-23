<?php

declare(strict_types=1);

namespace Check24\Assignment\Comment\Query\FetchByArticle;

interface CommentsByArticleFetcherInterface
{
    public function fetchByArticle(int $articleId): CommentByArticleViewModelCollection;
}
