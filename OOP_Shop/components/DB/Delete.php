<?php


namespace app\components\DB;


use app\components\traits\WhereTrait;
use app\exceptions\DataBaseException;

class Delete extends AbstractQuery
{
    use WhereTrait;

    /**
     * @param string $table
     * @return $this
     * @throws DataBaseException
     */
    public function from(string $table) : self
    {
        $this->table = $table;
        $this->sql = $this->buildSQL();
        return $this;
    }

    /**
     * @throws DataBaseException
     */
    protected function buildSQL() : string
    {
        if(!$this->table){
            throw new DataBaseException("Data or table is incorrect");
        }

        return "DELETE FROM `{$this->table}`";
    }
}