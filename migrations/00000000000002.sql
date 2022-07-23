CREATE TABLE comments
(
    id         SERIAL PRIMARY KEY          NOT NULL,
    author_id  INT                         NOT NULL,
    article_id INT                         NOT NULL,
    name       VARCHAR(100)                NOT NULL,
    url        VARCHAR(200)                NULL,
    email      VARCHAR(200)                NULL,
    text       TEXT                        NOT NULL,
    created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL
);
CREATE INDEX comments_article_id_idx ON comments (article_id);
