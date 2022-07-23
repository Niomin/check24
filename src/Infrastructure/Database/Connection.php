<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Database;

use Closure;
use PDO;
use Throwable;

final class Connection
{
    public function __construct(
        private readonly PDO $pdo
    ) {
    }

    public function execute(string $sql): void
    {
        $this->pdo->exec($sql);
    }

    public function transactional(Closure $fn): void
    {
        $this->pdo->beginTransaction();
        try {
            $fn();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
        $this->pdo->commit();
    }
}
