<?php


class Mentor extends Homework
{
    private string $studentHomework = '';

    /**
     * @return string
     */
    public function getStudentHomework(): string
    {
        return $this->studentHomework;
    }

    /**
     * @param string $studentHomework
     */
    public function setStudentHomework(string $studentHomework): void
    {
        $this->studentHomework = $studentHomework;
    }
    public function sendHomework($homework)
    {
        $this->memory['studentHomework'] = $homework;
    }

    public function evaluationHomework(){
        $this->memory['grade'] = mt_rand(1,12);
        return $this->memory['grade'];
    }
}