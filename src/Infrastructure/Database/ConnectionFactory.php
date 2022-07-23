<?php

declare(strict_types=1);

namespace Check24\Assignment\Infrastructure\Database;

use Check24\Assignment\Infrastructure\ConfigReader;
use PDO;

use function sprintf;

final class ConnectionFactory
{
    public function create(): Connection
    {
        $configReader = new ConfigReader();
        $dsn = sprintf(
            'pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s',
            $configReader->get('POSTGRES_HOST'),
            (int)$configReader->get('POSTGRES_PORT'),
            $configReader->get('POSTGRES_DB'),
            $configReader->get('POSTGRES_USER'),
            $configReader->get('POSTGRES_PASSWORD'),
        );
        $pdo = new PDO($dsn);
        
        return new Connection($pdo);
    }
}
