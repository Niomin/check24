<?php

declare(strict_types=1);

namespace Check24\Assignment\Comment\Query\FetchByArticle;

use DateTimeImmutable;
use JsonSerializable;

final class CommentByArticleViewModel implements JsonSerializable
{
    public function __construct(
        private readonly int               $id,
        private readonly string            $name,
        private readonly ?string           $email,
        private readonly ?string           $url,
        private readonly string            $text,
        private readonly DateTimeImmutable $createdAt
    ) {
    }

    /** @return mixed[] */
    public function jsonSerialize(): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'url'       => $this->url,
            'text'      => $this->text,
            'createdAt' => $this->createdAt->format(DateTimeImmutable::RFC3339),
        ];
    }
}
