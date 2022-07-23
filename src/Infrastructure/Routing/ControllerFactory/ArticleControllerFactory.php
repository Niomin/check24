<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Routing\ControllerFactory;

use Check24\Assignment\Article\Query\FetchById\ArticleByIdQuery;
use Check24\Assignment\Article\Query\FetchList\ArticleListQuery;
use Check24\Assignment\Comment\Infrastructure\Database\CommentsByArticleFetcher;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentsByArticleQuery;
use Check24\Assignment\Infrastructure\Database\ConnectionFactory;
use Check24\Assignment\Infrastructure\Routing\ControllerFactoryInterface;
use Check24\Assignment\Post\Infrastructure\Database\ArticleByIdFetcher;
use Check24\Assignment\Post\Infrastructure\Database\ArticleListFetcher;
use Check24\Assignment\Presentation\Controller\ArticleController;

final class ArticleControllerFactory implements ControllerFactoryInterface
{
    public function create(): ArticleController
    {
        $connection = (new ConnectionFactory())->create();
        return new ArticleController(
            new ArticleListQuery(
                new ArticleListFetcher($connection)
            ),
            new ArticleByIdQuery(
                new ArticleByIdFetcher($connection)
            ),
            new CommentsByArticleQuery(
                new CommentsByArticleFetcher($connection)
            )
        );
    }

    public function canProcess(string $path, array $parsedQuery): bool
    {
        $exploded = explode('/', $path);

        return ($exploded[1] ?? null) === 'articles';
    }
}
