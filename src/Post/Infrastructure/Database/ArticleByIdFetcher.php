<?php

declare(strict_types=1);

namespace Check24\Assignment\Post\Infrastructure\Database;

use Check24\Assignment\Article\Query\FetchById\ArticleByIdFetcherInterface;
use Check24\Assignment\Infrastructure\Database\Connection;
use Check24\Assignment\Article\Query\FetchById\ArticleByIdViewModel;
use DateTimeImmutable;

final class ArticleByIdFetcher implements ArticleByIdFetcherInterface
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function fetch(int $id): ?ArticleByIdViewModel
    {
        $sql     = 'SELECT * FROM articles WHERE id = :id';
        $rawData = $this->connection->fetchOne($sql, ['id' => $id]);

        if (null === $rawData) {
            return null;
        }

        //todo we should use here separated hydrator
        return new ArticleByIdViewModel(
            $rawData['id'],
            $rawData['author_id'],
            $rawData['title'],
            $rawData['text'],
            new DateTimeImmutable($rawData['createdAt'])
        );
    }
}
