<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Database;

use Closure;
use PDO;
use Throwable;

//TODO think of lazy connection
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

    /**
     * @param mixed[]  $parameters
     * @return mixed[]
     */
    public function fetchOne(string $sql, array $parameters): ?array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);

        $result = $stmt->fetch();

        if (false === $result) {
            return null;
        }

        return $result;
    }

    /**
     * @param string $sql
     * @param mixed[]  $parameters
     * @return mixed[]
     */
    public function fetchAll(string $sql, array $parameters): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);

        return $stmt->fetchAll();
    }
}
