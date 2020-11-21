<?php


class Student extends Human
{
    public function homework(){
        $days = random_int(1,10);
        $date = (new DateTime('now'))->modify("+{$days} day")->format('d-m-Y');
        $this->memory['homeworkDate'] = $date;
        return $date;
    }
}