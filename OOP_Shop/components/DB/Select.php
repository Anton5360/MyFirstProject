<?php


namespace app\components\DB;


use app\components\traits\WhereTrait;
use app\exceptions\DataBaseException;
use PDO;
use PDOException;

class Select extends AbstractQuery
{

    use WhereTrait;

    private array $fields = [];

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields) : self
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param $table
     * @return $this
     * @throws DataBaseException
     */
    public function from($table) : self
    {
        $this->table = $table;
        $this->sql = $this->buildSQL();
        return $this;
    }


    public function findAll(int $mode = PDO::FETCH_ASSOC)
    {
        $this->execute();

        if(!$this->stmt){
            return [];
        }
//        var_dump($this->stmt);exit;
        return $this->stmt->fetchAll($mode);
    }

    public function findOne(int $mode = PDO::FETCH_ASSOC)
    {
        $this->execute();

        if(!$this->stmt){
            return false;
        }
//        var_dump($this->stmt);exit;
        return $this->stmt->fetch($mode);
    }


    /**
     * @return string
     * @throws DataBaseException
     */
    protected function buildSQL() : string
    {
        if(!$this->fields || !$this->table){
            throw new DataBaseException("Data or table is incorrect");
        }
        if($this->fields[0] !== '*')
            $fields = '`' . implode('`, `',$this->fields) . '`';
        else {
            $fields = $this->fields[0];
        }
//        $this->sql = "SELECT {$fields} FROM `{$this->table}`";
//        var_dump($fields);exit;
        return "SELECT {$fields} FROM `{$this->table}`";
    }


}