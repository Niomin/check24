<?php

declare(strict_types=1);

namespace Check24\Assignment\Tests\Comment\Query;

use Check24\Assignment\Article\Query\FetchList\ArticleInListViewModelCollection;
use Check24\Assignment\Article\Query\FetchList\ArticleListRequest;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentByArticleViewModelCollection;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentsByArticleFetcherInterface;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentsByArticleQuery;
use Check24\Assignment\Tests\AbstractUnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * This test is useless, because the class doesn't do anything.
 * However, I can't live if I know that query/application service is not tested.
 */
final class CommentsByArticleQueryTest extends AbstractUnitTestCase
{
    private CommentsByArticleFetcherInterface&MockObject $fetcher;
    private CommentsByArticleQuery                       $query;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fetcher = $this->createMock(CommentsByArticleFetcherInterface::class);

        $this->query = new CommentsByArticleQuery($this->fetcher);
    }

    public function testGetByArticle(): void
    {
        $this->fetcher
            ->expects($this->once())
            ->method('fetchByArticle')
            ->with($articleId = 777)
            ->willReturn($fetched = new CommentByArticleViewModelCollection([]));

        self::assertEquals(
            $fetched,
            $this->query->getByArticle($articleId)
        );
    }
}
