CREATE TABLE users
(
    id            SERIAL PRIMARY KEY,
    name          VARCHAR(100),
    password_hash VARCHAR(255),
    salt          VARCHAR(100)
);
CREATE TABLE articles
(
    id         SERIAL PRIMARY KEY,
    author_id  INT,
    title      VARCHAR(512),
    text       TEXT,
    created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL,
    FOREIGN KEY (author_id) REFERENCES users (id)
);