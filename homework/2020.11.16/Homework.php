<?php


class Homework extends Duties
{
    public string $doneHomework = '';
    public function getHomework($homework){
        if(!array_key_exists('homework', $this->memory)) {
            $this->memory['homework'] = $homework;
            return $homework;
        }
    }
    public function homeworkIsDone() : bool
    {
        if(strpos($this->memory['homework'], 'is done') !== false){
            $this->doneHomework = str_replace('is done', '', $this->memory['homework']);
            return true;
        }
        return false;
    }
}