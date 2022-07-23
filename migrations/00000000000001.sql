CREATE TABLE users
(
    id            SERIAL PRIMARY KEY NOT NULL,
    name          VARCHAR(100)       NOT NULL,
    password_hash VARCHAR(255)       NOT NULL,
    salt          VARCHAR(100)       NOT NULL
);
CREATE TABLE articles
(
    id         SERIAL PRIMARY KEY          NOT NULL,
    author_id  INT                         NOT NULL,
    title      VARCHAR(512)                NOT NULL,
    text       TEXT                        NOT NULL,
    created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL
);
CREATE INDEX articles_created_at_idx ON articles (created_at);
