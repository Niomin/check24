<?php

declare(strict_types=1);

namespace Check24\Assignment\Presentation\Controller;

use Check24\Assignment\Article\Query\FetchById\ArticleByIdNotFoundException;
use Check24\Assignment\Article\Query\FetchById\ArticleByIdQuery;
use Check24\Assignment\Article\Query\FetchById\ArticleByIdViewModel;
use Check24\Assignment\Article\Query\FetchList\ArticleInListViewModelCollection;
use Check24\Assignment\Article\Query\FetchList\ArticleListQuery;
use Check24\Assignment\Article\Query\FetchList\ArticleListRequest;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentByArticleViewModelCollection;
use Check24\Assignment\Comment\Query\FetchByArticle\CommentsByArticleQuery;
use Check24\Assignment\Infrastructure\Routing\ControllerInterface;
use Check24\Assignment\Infrastructure\Routing\Exception\HttpBadRequestException;
use Check24\Assignment\Infrastructure\Routing\Exception\HttpNotFoundException;
use DateTimeImmutable;

use DateTimeInterface;

use function sprintf;

//TODO add information about authors, not only ids
//TODO we need some functional tests
final class ArticlesController implements ControllerInterface
{
    public function __construct(
        private readonly ArticleListQuery       $articleListQuery,
        private readonly ArticleByIdQuery       $articleByIdQuery,
        private readonly CommentsByArticleQuery $commentsByArticleQuery
    ) {
    }

    public function process(string $path, array $query): mixed
    {
        if ($path === '/articles') {
            return $this->getList($query);
        }
        $exploded = explode('/', $path);
        if (count($exploded) === 3 && $exploded[0] === '' && $exploded[1] === 'articles' && is_numeric($exploded[2])) {
            return $this->getById((int)$exploded[2]);
        }

        throw new HttpNotFoundException();
    }

    /** @param mixed[] $query */
    private function getList(array $query): ArticleInListViewModelCollection
    {
        $lastId        = $query['lastId'] ?? null;
        $lastCreatedAt = null;
        if (isset($query['lastCreatedAt'])) {
            $lastCreatedAt = DateTimeImmutable::createFromFormat(
                DateTimeInterface::RFC3339,
                $query['lastCreatedAt']
            );
            if (false === $lastCreatedAt) {
                throw new HttpBadRequestException('Wrong DateTime format, please, use RFC3339');
            }
        }
        if ((null === $lastId && $lastCreatedAt !== null) || (null !== $lastId && null === $lastCreatedAt)) {
            throw new HttpBadRequestException('You should provide both parameters: lastId and lastCreatedAt, or none of them');
        }

        if (null === $lastCreatedAt) {
            return $this->articleListQuery->getList(null);
        }

        return $this->articleListQuery->getList(new ArticleListRequest($lastCreatedAt, $lastId));
    }

    /**
     * @return array{'article': ArticleByIdViewModel, 'comments': CommentByArticleViewModelCollection}
     */
    private function getById(int $articleId): array
    {
        try {
            $article  = $this->articleByIdQuery->getById($articleId);
            $comments = $this->commentsByArticleQuery->getByArticle($articleId);

            return [
                'article'  => $article,
                'comments' => $comments,
            ];
        } catch (ArticleByIdNotFoundException $e) {
            throw new HttpNotFoundException(sprintf('Article %d not found', $articleId), $e);
        }
    }
}
