<?php

namespace Bukubuku\Core;

use Bukubuku\Core\exception\DatabaseException;

class Database
{

    /*Instance of PDO class. We define is as private and channel all
    communication with the database through the Database class.*/
    private \PDO $pdo;

    public function __construct(string $dsn, string $username, string $password)
    {
        try {
            $this->pdo = new \PDO($dsn, $username, $password);
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }

        //Throw exceptions in case of errors.
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //Set the fetch mode to FETCH_ASSOC.
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    //Prepare a statement.
    public function prepare(string $query): \PDOStatement|false
    {
        try {
            return $this->pdo->prepare($query);
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    //The following three methods are used for transaction handling.
    //Begin a new transaction.
    public function beginTransaction(): bool
    {
        try {
            return $this->pdo->beginTransaction();
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    //Commit the running transaction.
    public function commit(): bool
    {
        try {
            return $this->pdo->commit();
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    //Rollback the running transaction.
    public function rollback(): bool
    {
        try {
            return $this->pdo->rollBack();
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }
}
