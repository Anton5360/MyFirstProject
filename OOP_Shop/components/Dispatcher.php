<?php


namespace app\components;

use helpers\StringHelper;

/**
 * Class Dispatcher
 * @package components
 */
class Dispatcher
{
    private const DEFAULT_CONTROLLER = 'index';
    private const DEFAULT_ACTION = 'index';
    /**
     * @var string
     */
    private string $address = '';
    /**
     * @var string
     */
    private string $controller = '';
    /**
     * @var string
     */
    private string $action = '';

    private array $params = [];


    /**
     * Dispatcher constructor.
     * @param $address
     */
public function __construct($address, $separator = '/')
{
    $this->prepareAddress($address);
    $this->dispatch($separator);

}

public function dispatch($separator = '/'){
    $parts = explode($separator, StringHelper::ltrim($this->address, $separator));
    $this->controller = array_shift($parts) ?: self::DEFAULT_CONTROLLER;
    $this->action = array_shift($parts) ?: self::DEFAULT_ACTION;
    $this->prepareParts($parts);
    var_dump($this->controller,$this->action);
}

public function getControllerPart(){
    return $this->controller;
}


private function prepareAddress(string $address){
    $separator = strpos($address, '?');
    $upgradeAddress = $address;
    if($separator !== false){
    $upgradeAddress = substr($address, 0, $separator);
    }
    $this->address = $upgradeAddress;
}

private function prepareParts( array $parts){
    $keys = [];
    $values = [];
    foreach($parts as $key => $value){
        if($key % 2 === 0){
            $keys[] = $value;
        } else{
            $values[] = $value;
        }
    }
    if(count($keys) > count($values)){
        $values[] = NULL;
    }
    $readyArray = array_merge(array_combine($keys, $values), $_GET);
    $this->params = $readyArray;
    var_dump($this->params);
}



}

