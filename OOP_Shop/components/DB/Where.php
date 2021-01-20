<?php


namespace app\components\DB;


class Where
{

    private string $sql = '';
    private bool $isWhere = false;

    /**
     * Where constructor.
     * @param string $sql
     */
    public function __construct(string $sql)
    {
        $this->sql = $sql;
    }

    public function equal(array $data) : void
    {
        $this->isHasWhere();
        $isString = is_string($data[2]);
        foreach($data as $key => $element){
            switch($key){
                case 0:
                    $this->sql .= ' `' . $element . '`';
                    break;
                case 2:
                    if($isString) {
                        $this->sql .= ' \'' . $element . '\'';
                        break;
                    }
                    $this->sql .= ' ' . $element . '';
                    break;
                default:
                    $this->sql .= ' ' . $element;
            }
        }
//        if($data[1] === '=') {
//            var_dump($this->sql, $data);
//            exit;
//        }
//        return $this->sql;
    }

    public function between(array $data) : void
    {
        $this->isHasWhere();
        $data[1] = strtoupper($data[1]);
        foreach($data as $key => $element){
            $isString = is_string($element);
            switch($key){
                case 0:
                    $this->sql .= ' `' . $element . '`';
                    break;
                case 2:
                    if($isString) {
                        $this->sql .= ' \'' . $element . '\' AND';
                        break;
                    }
                    $this->sql .= ' ' . $element . ' AND';
                    break;
                case 3:
                    if($isString) {
                        $this->sql .= ' \'' . $element . '\'';
                        break;
                    }
                    $this->sql .= ' ' . $element . '';
                    break;
                default:
                    $this->sql .= ' ' . $element;
            }
        }
//        var_dump($this->sql);exit;
//        return $this->sql;
    }

    public function in(array $data) : void
    {
        $isString = is_string($data[2]);
        $condition = '';
        $this->isHasWhere();
        $data[1] = strtoupper($data[1]);

        foreach($data as $key => $element){
            switch($key){
                case 0:
                    $this->sql .= ' `' . $element . '`';
                    break;
                case 1:
                    $this->sql .= ' ' . $element;
                    break;
                case 2:
                    if($isString) {
                        $this->sql .= ' (\'' . $element;
                        break;
                    }
                    $this->sql .= ' (' . $element;
                    break;
                case $element === 'AND' || $element === 'OR':
                    $condition = ' '. $element;
                    break;
                default:
                    if($isString) {
                        $this->sql .= '\', \'' . $element . '';
                        break;
                    }
                    $this->sql .= ', ' . $element . '';
            }
        }
        if($isString) {
            $this->sql .= '\')' . $condition;
        } else{
            $this->sql .= ')' . $condition;
        }
//        var_dump($this->sql);exit;
//        return $this->sql;
    }


    public function null(array $data) : void
    {
//        var_dump($data);exit;
        $this->isHasWhere();

        foreach($data as $key => $element){
            switch($key){
                case 0:
                    $this->sql .= ' `' . $element . '`';
                    break;
                case 1:
                    $this->sql .= ' IS ' . $element;
                    break;
                default:
                    $this->sql .= ' ' . $element;
            }
        }
//        var_dump($this->sql);exit;
//        return $this->sql;
    }

    public function getSQL() : string
    {
        return $this->sql;
    }

    private function isHasWhere() : void
    {
        if(!$this->isWhere) {
            $this->sql .= ' WHERE';
            $this->isWhere = true;
        }
    }
}