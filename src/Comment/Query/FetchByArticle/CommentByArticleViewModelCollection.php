<?php

declare(strict_types=1);

namespace Check24\Assignment\Comment\Query\FetchByArticle;

use JetBrains\PhpStorm\Internal\TentativeType;
use JsonSerializable;

final class CommentByArticleViewModelCollection implements JsonSerializable
{
    /**
     * @param CommentByArticleViewModel[] $comments
     */
    public function __construct(
        private readonly array $comments
    ) {
    }

    /** @return mixed[] */
    public function jsonSerialize(): array
    {
        return [
            'comments' => $this->comments
        ];
    }
}
