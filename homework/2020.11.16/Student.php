<?php


class Student extends Homework
{
    public int $grade = 0;
    public function doingHomework(){
        $this->memory['homework'] .= ' is done';
    }

}