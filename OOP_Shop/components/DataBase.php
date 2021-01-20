<?php


namespace app\components;


use app\components\DB\Delete;
use app\components\DB\Insert;
use app\components\DB\Select;
use app\components\DB\Update;
use PDO;

class DataBase
{

    private PDO $connection;

    public function __construct(string $name, string $user, string $password, string $host)
    {
        $this->connection = new PDO("mysql:host={$host};dbname={$name};charset=utf8", $user, $password);
    }

    public function insert(array $data) : Insert
    {
//        var_dump($this->connection);
        return ((new Insert($this->connection))->setData($data));
    }

    public function select(array $fields) : Select
    {
        return (new Select($this->connection))->setFields($fields);
    }

    public function update(string $table) : Update
    {
        return (new Update($this->connection))->setTable($table);
    }

    public function delete() : Delete
    {
        return (new Delete($this->connection));
    }

}