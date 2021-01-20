<?php


namespace app\components\DB;


use app\components\traits\WhereTrait;
use app\exceptions\DataBaseException;

class Update extends AbstractQuery
{
    use WhereTrait;
    private ?array $params = null;


    /**
     * @param array $params
     * @return $this
     * @throws DataBaseException
     */
    public function set(array $params) : self
    {
        $this->params = $params;
        $this->sql = $this->buildSQL();
        return $this;
    }


    public function setTable(string $table) : self
    {
        $this->table = $table;
        return $this;
    }


    /**
     * @throws DataBaseException
     */
    protected function buildSQL() : string
    {
        if(!$this->params || !$this->table){
            throw new DataBaseException("Data or table is incorrect");
        }

        $updateSQL = $this->prepareParams();

//        var_dump("UPDATE `{$this->table}` SET {$updateSQL}");exit;

        return "UPDATE `{$this->table}` SET {$updateSQL}";
    }

    private function prepareParams()
    {
        $result = [];
        foreach ($this->params as $key => $param) {
            if (is_string($param)) {
                $result[] = "`{$key}` = '{$param}'";
            } else{
                $result[] = "`{$key}` = {$param}";
            }
        }
//        var_dump($updateSQL);
//        exit;
        return implode(', ', $result);
    }

}
