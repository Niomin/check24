<?php

declare(strict_types=1);

namespace Check24\Assignment\Comment\Infrastructure\Database;

use Check24\Assignment\Comment\Query\FetchByArticle\CommentByArticleViewModel;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentByArticleViewModelCollection;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentsByArticleFetcherInterface;
use Check24\Assignment\Infrastructure\Database\Connection;

use DateTimeImmutable;

use function array_map;

final class CommentsByArticleFetcher implements CommentsByArticleFetcherInterface
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function fetchByArticle(int $articleId): CommentByArticleViewModelCollection
    {
        $sql = 'SELECT * FROM comments WHERE article_id = :articleId';
        $commentsRaw = $this->connection->fetchAll($sql, ['articleId' => $articleId]);

        return new CommentByArticleViewModelCollection(
            array_map(
                fn(array $commentRaw) => $this->hydrateComment($commentRaw),
                $commentsRaw
            )
        );
    }

    /** @param mixed[] $commentRaw */
    private function hydrateComment(array $commentRaw): CommentByArticleViewModel
    {
        return new CommentByArticleViewModel(
            $commentRaw['id'],
            $commentRaw['name'],
            $commentRaw['email'],
            $commentRaw['url'],
            $commentRaw['text'],
            new DateTimeImmutable($commentRaw['created_at'])
        );
    }
}
