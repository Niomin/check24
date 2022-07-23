<?php

declare(strict_types=1);

namespace Check24\Assignment\Post\Infrastructure\Database;

use Check24\Assignment\Article\Query\FetchList\ArticleListFetcherInterface;
use Check24\Assignment\Article\Query\FetchList\ArticleInListViewModel;
use Check24\Assignment\Article\Query\FetchList\ArticleInListViewModelCollection;
use Check24\Assignment\Infrastructure\Database\Connection;
use DateTimeImmutable;

use function array_map;

final class ArticleListFetcher implements ArticleListFetcherInterface
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function fetch(DateTimeImmutable $lastCreatedAt, int $lastId): ArticleInListViewModelCollection
    {
        $sql = '
SELECT 
    id, title, author_id, created_at, SUBSTR(text, 0, 1000)
FROM articles
WHERE 
     created_at < :lastCreatedAt 
  OR created_at = :lastCreatedAt AND 
     id < :lastId
    ';

        $rawData = $this->connection->fetchAll(
            $sql,
            [
                'lastCreatedAt' => $lastCreatedAt->format(DateTimeImmutable::RFC3339),
                'lastId'        => $lastId,
            ]
        );

        return new ArticleInListViewModelCollection(
            array_map(
                fn(array $raw) => $this->hydrateArticleList($raw),
                $rawData
            )
        );
    }

    /** @param mixed[] $raw */
    private function hydrateArticleList(array $raw): ArticleInListViewModel
    {
        return new ArticleInListViewModel(
            $raw['id'],
            $raw['author_id'],
            $raw['title'],
            $raw['text'],
            new DateTimeImmutable($raw['created_at'])
        );
    }
}
