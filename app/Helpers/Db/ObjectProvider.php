<?php

namespace App\Helpers\Db;

use PDOStatement;

trait ObjectProvider
{
    /**
     * @param PDOStatement $statement
     * @param int $pdoMode
     * @return null|mixed
     */
    public function fetch(PDOStatement $statement, int $pdoMode)
    {
        $arr = $statement->fetch($pdoMode);

        return !empty($arr) ? $arr : null;
    }

    /**
     * @param PDOStatement $statement
     * @param string $class
     * @return null|mixed
     */
    public function fetchObject(PDOStatement $statement, string $class)
    {
        $object = $statement->fetchObject($class);

        return !empty($object) ? $object : null;
    }

    /**
     * @param PDOStatement $statement
     * @param string $class
     * @return null|array
     */
    public function fetchObjects(PDOStatement $statement, string $class)
    {
        $objects = $statement->fetchAll(\PDO::FETCH_CLASS, $class);

        return !empty($objects) ? $objects : null;
    }
}
