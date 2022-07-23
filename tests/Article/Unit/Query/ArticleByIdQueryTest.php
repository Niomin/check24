<?php

declare(strict_types=1);

namespace Check24\Assignment\Tests\Article\Unit\Query;

use Check24\Assignment\Article\Query\FetchById\ArticleByIdFetcherInterface;
use Check24\Assignment\Article\Query\FetchById\ArticleByIdQuery;
use Check24\Assignment\Article\Query\FetchById\ArticleByIdNotFoundException;
use Check24\Assignment\Article\Query\FetchById\ArticleByIdViewModel;
use Check24\Assignment\Tests\AbstractUnitTestCase;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;

final class ArticleByIdQueryTest extends AbstractUnitTestCase
{
    private MockObject&ArticleByIdFetcherInterface $fetcher;
    private ArticleByIdQuery                       $query;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fetcher = $this->createMock(ArticleByIdFetcherInterface::class);

        $this->query = new ArticleByIdQuery($this->fetcher);
    }

    public function testFetchNotFound(): void
    {
        $this->fetcher->expects($this->once())->method('fetch')->with($id = 1)->willReturn(null);

        $this->expectException(ArticleByIdNotFoundException::class);
        $this->query->getById($id);
    }

    public function testFetch(): void
    {
        $this->fetcher
            ->expects($this->once())
            ->method('fetch')
            ->with($id = 777)
            ->willReturn(
                $fetched = new ArticleByIdViewModel(
                    1,
                    2,
                    'title',
                    'text',
                    new DateTimeImmutable()
                ));

        self::assertEquals(
            $fetched,
            $this->query->getById($id)
        );
    }
}
