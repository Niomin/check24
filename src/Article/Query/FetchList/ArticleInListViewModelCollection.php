<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchList;

use JsonSerializable;

final class ArticleInListViewModelCollection implements JsonSerializable
{
    /**
     * @param ArticleInListViewModel[] $viewModels
     */
    public function __construct(
        private readonly array $viewModels
    ) {
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'articles' => $this->viewModels,
        ];
    }
}
