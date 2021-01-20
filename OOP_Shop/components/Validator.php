<?php


namespace app\components;


class Validator extends AbstractValidator
{
    protected array $result = [];
//    protected array $errors = [];


    public function run(array $data, array $rules) : self
    {
        $errors = [];
        $isValid = false;
        $result = [];
        foreach($data as $key => $value){
            if(!array_key_exists($key, $rules)) {
                if($key !== 'confirm_password')
                    $result[$key] = $value;
                continue;
            }
            foreach($rules[$key] as $element) {
                $element->validate($value);
                $isValid = $element->isValid();
//                var_dump($isValid);
                if(!$isValid){
                    if(array_key_exists($key,$errors)){
                        $errors[$key] = array_merge($errors[$key], $element->getErrors());
//                        var_dump($errors);
                    } else{
                        $errors[$key] = $element->getErrors();
                    }
//                    break;
                }
//                var_dump($element);exit;
                $result[$key] = $value;
            }
        }

        $this->errors = $errors;
        $this->result = $result;
      return $this;
    }

    public function getValidData() : array
    {
        return $this->result;
    }

//    public function getErrors() : array
//    {
//        return $this->errors;
//    }
}