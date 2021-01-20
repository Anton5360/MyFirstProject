<?php


namespace app\components\DB;


use app\exceptions\DataBaseException;
use PDOException;

class Insert extends AbstractQuery
{
    protected array $data = [];

    public function setData(array $data) : self
    {
        $this->data = $data;
        return $this;
    }

    public function into(string $table) : self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return bool
     * @throws DataBaseException
     */
    public function execute() : bool
    {
//        var_dump($this->sql);
        $stmt = $this->connection->prepare($this->buildSQL());

        $result = $stmt->execute($this->data);

        if(!$result){
            throw new PDOException("Something was wrong");
        }

        return true;
    }

    /**
     * @return string
     * @throws DataBaseException
     */
    protected function buildSQL() : string
    {
        $keys = array_keys($this->data);
        $fields = '`' . implode('`, `', $keys) . '`';
        $stmtFields = ':' . implode(', :', $keys);
        if(!$this->data || !$this->table){
            throw new DataBaseException("Data or table is incorrect");
        }
        return "INSERT INTO {$this->table} ({$fields}) VALUES ({$stmtFields})";
    }
}