<?php


namespace app\components\traits;


use app\components\DB\Where;

trait WhereTrait
{
    public function where(array $data) : object
    {
        $sql = $this->sql;

        if(empty($data)){
            return $sql;
        }

        $query = new Where($sql);


        foreach($data as $key => $value){
//            var_dump($value);exit;
            switch($value[1]){
                case '=':
                case '!=':
                case '<':
                case '>':
                case '<=':
                case '>=':
                case 'LIKE':
                    $query->equal($value);
                    break;
                case 'between':
                    $query->between($value);
                    break;
                case 'in':
                    $query->in($value);
                    break;
                case 'NULL':
                case 'NOT NULL':
                    $query->null($value);
            }
        }
        $this->sql = $query->getSQL();
//        var_dump($this->sql);exit;
        return $this;
    }
}