<?php

namespace App\Repositories\Test;

use App\Core\Errors;
use App\Exceptions\SQLException;
use PDO;
use App\Helpers\Db\ObjectProvider;

class TestRepository implements TestRepositoryInterface
{
    use ObjectProvider;

    /* @var PDO $connection */
    public $connection;

    /**
     * TestRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $migrationName
     * @return null|array
     * @throws SQLException
     */
    public function retrieveOne(string $migrationName): ?array
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM public.phinxlog WHERE migration_name = :migration_name
        ');
        $stmt->bindValue(':migration_name', $migrationName, PDO::PARAM_STR);
        if(!$stmt->execute()) {
            throw new SQLException('Some sql error', Errors::SQL_ERROR);
        }

        return $this->fetch($stmt, PDO::FETCH_ASSOC);
    }
}
