<?php

declare(strict_types=1);

namespace Check24\Assignment\Tests\User\Unit\Query;

use Check24\Assignment\Comment\Query\FetchByArticle\CommentByArticleViewModelCollection;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentsByArticleFetcherInterface;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentsByArticleQuery;
use Check24\Assignment\Tests\AbstractUnitTestCase;
use Check24\Assignment\User\Query\FetchAuthors\UserAuthorViewModelCollection;
use Check24\Assignment\User\Query\FetchAuthors\UsersAuthorsFetcherInterface;
use Check24\Assignment\User\Query\FetchAuthors\UsersAuthorsQuery;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * This test is useless, because the class doesn't do anything.
 * However, I can't live if I know that query/application service is not tested.
 */
final class UsersAuthorsQueryTest extends AbstractUnitTestCase
{
    private UsersAuthorsFetcherInterface&MockObject $fetcher;
    private UsersAuthorsQuery                       $query;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fetcher = $this->createMock(UsersAuthorsFetcherInterface::class);

        $this->query = new UsersAuthorsQuery($this->fetcher);
    }

    public function testGetByArticle(): void
    {
        $this->fetcher
            ->expects($this->once())
            ->method('fetchAuthors')
            ->with()
            ->willReturn($fetched = new UserAuthorViewModelCollection([]));

        self::assertEquals(
            $fetched,
            $this->query->getAuthors()
        );
    }
}
