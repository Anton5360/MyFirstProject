<?php


namespace app\components\validators;


use app\components\AbstractValidator;
use app\exceptions\InvalidConfigException;

class CompareValidator extends AbstractValidator
{
    private array $data = [];
    private string $keyFirst = '';
    private string $keySecond = '';

    public function __construct(array $data, string $keyFirst, string $keySecond)
    {
        $this->data = $data;
        $this->keyFirst = $keyFirst;
        $this->keySecond = $keySecond;
    }

    public function validate() : void
    {
        if(
            !array_key_exists($this->keyFirst, $this->data)
            ||
            !array_key_exists($this->keySecond, $this->data)
        )
        {
            throw new InvalidConfigException('Invalid keys passed');
        }

        if($this->data[$this->keyFirst] !== $this->data[$this->keySecond]){
            $this->errors[] = "{$this->keySecond} must be equal to {$this->keyFirst}";
        }
//        var_dump( $this->errors);exit;
    }
}