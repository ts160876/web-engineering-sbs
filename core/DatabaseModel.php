<?php

namespace Bukubuku\Core;

abstract class DatabaseModel extends Model
{
    /*The following abstract methods have to be implemented in subclasses.
    They include database-related information:
    - getTableName: get the name of the database table used to store data from this model
    - getPrimaryKeyName: get the name of the primary key column (currently only a single column
      can be used as primary key)
    - columnMapping: map the column=>property*/
    static abstract protected function getTableName(): string;
    static abstract protected function getPrimaryKeyName(): string;
    static abstract protected function columnMapping(): array;

    //Check if a record with a given primary key value does already exist.
    static public function checkExistence(int $primaryKeyValue): bool
    {
        $tableName = static::getTableName();
        $primaryKeyName = static::getPrimaryKeyName();

        //Create SQL statement.
        $query = "SELECT COUNT(*) FROM $tableName WHERE $primaryKeyName = :$primaryKeyName;";
        $statement = static::prepare($query);

        //Bind the parameter and execute the statement.
        $statement->bindValue(":$primaryKeyName", $primaryKeyValue);
        $statement->execute();
        return $statement->fetchColumn();
    }

    //Determine the property for a given column.
    static public function columnToProperty(string $column): string|null
    {
        if (array_key_exists($column, static::columnMapping())) {
            return static::columnMapping()[$column];
        } else {
            return null;
        }
    }

    //Create a new instance of the model by reading the database.
    static public function fromDatabase($primaryKeyValue)
    {
        $tableName = static::getTableName();
        $columnNames = static::getColumnNames();
        $columnsWithAlias = array_map(fn($columnName) => static::addAlias($columnName), $columnNames);
        $primaryKeyName = static::getPrimaryKeyName();

        //Create SQL statement.
        $query = 'SELECT ' . implode(', ', $columnsWithAlias)  . ' FROM ' . $tableName . ' WHERE ' . $primaryKeyName . '= :' . $primaryKeyName . ';';
        $statement = static::prepare($query);

        //Execute the statement.
        $statement->execute([$primaryKeyName => $primaryKeyValue]);
        $properties = $statement->fetchAll()[0];

        return new static($properties);
    }

    //Read all records from the database. The function supports paging.
    static public function getAll(int $page = 0, int $limit = 10): array
    {
        $tableName = static::getTableName();
        $columnNames = static::getColumnNames();
        $columnsWithAlias = array_map(fn($columnName) => static::addAlias($columnName), $columnNames);

        //Create SQL statement.
        $query = 'SELECT ' . implode(', ', $columnsWithAlias)  . ' FROM ' . $tableName;
        if ($page != 0) {
            $query = $query . ' LIMIT :limit OFFSET :offset;';
            $offset = ($page - 1) * $limit;
        } else {
            $query = $query . ';';
        }

        $statement = static::prepare($query);

        //Bind the parameters.
        if ($page != 0) {
            $statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        }

        //Execute the statement.
        $statement->execute();
        return $statement->fetchAll();
    }

    //Get all columns of the database table.
    static public function getColumnNames(): array
    {
        return array_keys(static::columnMapping());
    }

    //Prepare SQL statement.
    static public function prepare($query)
    {
        return Application::$app->db->prepare($query);
    }

    //Determine the column for a given property.
    static public function propertyToColumn(string $property): string|null
    {
        $column = array_search($property, static::columnMapping());
        if ($column != false) {
            return $column;
        } else {
            return null;
        }
    }

    //Add an alias to column.
    static protected function addAlias(string $column): string
    {
        $alias = static::columnToProperty($column);
        return "$column AS $alias";
    }

    //Insert the instance of the model into the database.
    public function insert(): bool
    {
        $tableName = static::getTableName();
        $columnNames = static::getColumnNames();
        $parameters = array_map(fn($columnName) => ":$columnName", $columnNames);

        //Create SQL statement.
        $query = 'INSERT INTO ' . $tableName .  ' (' . implode(', ', $columnNames) . ') VALUES (' . implode(', ', $parameters) . ');';
        $statement = static::prepare($query);

        //Bind the parameters.
        foreach ($columnNames as $columnName) {
            $propertyName = static::columnToProperty($columnName);
            if ($propertyName != null) {
                $value = $this->{$propertyName};
                //Implement special logic for DateTime
                if ($value instanceof \DateTime) {
                    //$value = $value->format('Y-m-d');
                    $value = $value->format('Y-m-d H:i:s');
                }
            } else {
                $value = null;
            }

            $statement->bindValue(":$columnName", $value);
        }

        //Execute the statement.
        return $statement->execute();
    }

    //Update the instance of the model in the database.
    public function update(array $properties = []): bool
    {
        $tableName = static::getTableName();
        $primaryKeyName = static::getPrimaryKeyName();
        if (empty($properties)) {
            $columnNames = static::getColumnNames();
        } else {
            $columnNames = [];
            foreach ($properties as $property) {
                array_push($columnNames, static::propertyToColumn($property));
            }
        }
        $columnNames = array_diff($columnNames, [$primaryKeyName]);
        $columnNamesWithParameters = array_map(fn($columnName) => "$columnName = :$columnName", $columnNames);

        //Create SQL statement.
        $query = 'UPDATE ' . $tableName . ' SET ' . implode(', ', $columnNamesWithParameters) .
            ' WHERE ' . $primaryKeyName . ' = :' . $primaryKeyName . ';';
        $statement = static::prepare($query);

        //Bind the parameters.
        $primaryKeyPropertyName = static::columnToProperty($primaryKeyName);
        $statement->bindValue(":$primaryKeyName", $this->{$primaryKeyPropertyName});
        foreach ($columnNames as $columnName) {
            $propertyName = static::columnToProperty($columnName);
            if ($propertyName != null) {
                $value = $this->{$propertyName};
                //Implement special logic for DateTime
                if ($value instanceof \DateTime) {
                    $value = $value->format('Y-m-d H:i:s');
                }
            } else {
                $value = null;
            }

            $statement->bindValue(":$columnName", $value);
        }

        //Execute the statement.
        return $statement->execute();
    }

    //Check if the value of a the given property is unique and does not already exist in the database.
    protected function isUnique(string $propertyName): bool
    {
        $tableName = static::getTableName();
        $primaryKeyName = static::getPrimaryKeyName();
        $columnName = static::propertyToColumn($propertyName);

        //Create SQL statement.
        $query = "SELECT COUNT(*) FROM $tableName WHERE $primaryKeyName <> :$primaryKeyName AND $columnName = :$columnName;";
        $statement = static::prepare($query);

        //Bind the parameter and execute the statement.
        $value = $this->{$this->columnToProperty($primaryKeyName)};
        $statement->bindValue(":$primaryKeyName", $value);
        $value = $this->{$propertyName};
        $statement->bindValue(":$columnName", $value);
        $statement->execute();
        return !$statement->fetchColumn();
    }

    public function validateData(): bool
    {
        //First call the validations implemented in the Model class.
        parent::validateData();

        $rulesets = static::getRulesets();

        foreach ($rulesets as $property => $rules) {
            foreach ($rules as $ruleName => $parameters) {
                switch ($ruleName) {
                    case Rule::UNIQUE:
                        if ($this->isUnique($property) != true) {
                            $this->addError($property, 'Value already exists.');
                        }
                        break;
                }
            }
        }

        //Check if errors exist.
        return !$this->hasError();
    }
}
