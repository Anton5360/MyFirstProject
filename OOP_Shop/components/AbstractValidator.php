<?php


namespace app\components;


abstract class AbstractValidator
{
    protected array $errors = [];

    public function isValid() : bool
    {
        return empty($this->errors);
    }

    public function getErrors() : array
    {
        return $this->errors;
    }
}