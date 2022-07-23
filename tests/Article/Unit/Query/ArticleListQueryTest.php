<?php

declare(strict_types=1);

namespace Check24\Assignment\Tests\Article\Unit\Query;

use Check24\Assignment\Article\Query\FetchList\ArticleInListViewModelCollection;
use Check24\Assignment\Article\Query\FetchList\ArticleListFetcherInterface;
use Check24\Assignment\Article\Query\FetchList\ArticleListQuery;
use Check24\Assignment\Article\Query\FetchList\ArticleListRequest;
use Check24\Assignment\Tests\AbstractUnitTestCase;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * This test is useless, because class doesn't do anything.
 * However, I can't live if I know that query/application service is not tested.
 */
final class ArticleListQueryTest extends AbstractUnitTestCase
{
    private ArticleListFetcherInterface&MockObject $fetcher;
    private ArticleListQuery                       $query;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fetcher = $this->createMock(ArticleListFetcherInterface::class);

        $this->query = new ArticleListQuery($this->fetcher);
    }

    public function testFetchWhenEmptyRequest(): void
    {
        $this->fetcher
            ->expects($this->once())
            ->method('fetch')
            ->with($request = null)
            ->willReturn($fetched = new ArticleInListViewModelCollection([]));

        self::assertEquals(
            $fetched,
            $this->query->getList($request)
        );
    }

    public function testFetch(): void
    {
        $this->fetcher
            ->expects($this->once())
            ->method('fetch')
            ->with($request = new ArticleListRequest(new DateTimeImmutable(), 666))
            ->willReturn($fetched = new ArticleInListViewModelCollection([]));

        self::assertEquals(
            $fetched,
            $this->query->getList($request)
        );
    }
}
