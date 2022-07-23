<?php

declare(strict_types=1);

namespace Check24\Assignment\Post\Infrastructure\Database;

use Check24\Assignment\Article\Query\FetchList\ArticleListFetcherInterface;
use Check24\Assignment\Article\Query\FetchList\ArticleInListViewModel;
use Check24\Assignment\Article\Query\FetchList\ArticleInListViewModelCollection;
use Check24\Assignment\Article\Query\FetchList\ArticleListRequest;
use Check24\Assignment\Infrastructure\Database\Connection;
use DateTimeImmutable;

use function array_map;

final class ArticleListFetcher implements ArticleListFetcherInterface
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function fetch(?ArticleListRequest $request): ArticleInListViewModelCollection
    {
        $sql   = '
SELECT 
    id, title, author_id, created_at, SUBSTR(text, 0, 1000) as text
FROM articles
/* WHERE */
ORDER BY created_at DESC, id
LIMIT 3
    ';
        $binds = [];

        if (null !== $request) {
            $sql   = $this->appendWhereCondition($sql);
            $binds = [
                'lastCreatedAt' => $request->getLastCreatedAt()->format(DateTimeImmutable::RFC3339),
                'lastId'        => $request->getLastId(),
            ];
        }

        $rawData = $this->connection->fetchAll($sql, $binds);

        return new ArticleInListViewModelCollection(
            array_map(
                fn(array $raw) => $this->hydrateArticleList($raw),
                $rawData
            )
        );
    }

    private function appendWhereCondition(string $sql): string
    {
        return str_replace(
            '/* WHERE */',
            '
WHERE 
     created_at < :lastCreatedAt 
  OR created_at = :lastCreatedAt AND 
     id > :lastId',
            $sql
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
