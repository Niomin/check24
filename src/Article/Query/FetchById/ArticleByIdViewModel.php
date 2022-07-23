<?php

declare(strict_types=1);

namespace Check24\Assignment\Article\Query\FetchById;

use DateTimeImmutable;
use JsonSerializable;

final class ArticleByIdViewModel implements JsonSerializable
{
    public function __construct(
        private readonly int               $id,
        private readonly int               $authorId,
        private readonly string            $title,
        private readonly string            $text,
        private readonly DateTimeImmutable $createdAt
    ) {
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'id'        => $this->id,
            'authorId'  => $this->authorId,
            'title'     => $this->title,
            'text'      => $this->text,
            'createdAt' => $this->createdAt->format(DateTimeImmutable::RFC3339),
        ];
    }
}
