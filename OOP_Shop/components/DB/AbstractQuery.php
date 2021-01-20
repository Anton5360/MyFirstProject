<?php


namespace app\components\DB;


use PDO;
use PDOException;

abstract class AbstractQuery
{
    protected string $table = '';

    protected PDO $connection;

    protected $stmt;

    protected string $sql = '';

    /**
     * Insert constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return bool
     */
    public function execute() : bool
    {
        $this->stmt = $this->connection->prepare($this->sql);

//        var_dump($this->stmt);exit;

        $result = $this->stmt->execute();


        if(!$result){
            $info = json_encode($this->stmt->errorInfo());
            throw new PDOException("{$info}");
        }

        return true;
    }

    abstract protected function buildSQL();
}