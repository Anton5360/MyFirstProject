<?php


namespace app\components\validators;


use app\components\AbstractValidator;

class StringValidator extends AbstractValidator
{
    private int $min;
    private int $max;
    private string $fieldName;

    public function __construct(int $min, int $max, string $fieldName)
    {
        $this->min = $min;
        $this->max = $max;
        $this->fieldName = $fieldName;
    }

    public function validate($data)
    {
        $length = mb_strlen($data);

        if($length < $this->min)
        {
            $this->errors[] = "{$this->fieldName} should be min {$this->min} symbols";
        }
        if($length > $this->max)
        {
            $this->errors[] = "{$this->fieldName} should be max {$this->max} symbols";
        }
    }


}