<?php


namespace app\components;

use app\helpers\StringHelper;

/**
 * Class Dispatcher
 * @package components
 */
class Dispatcher
{
    private const DEFAULT_CONTROLLER = 'index';
    private const DEFAULT_ACTION = 'index';


    private string $address = '';
    public string $controller = '';
    public string $action = '';
    public array $params = [];

    /**
     * Dispatcher constructor.
     * @param $address
     * @param string $separator
     */

    public function __construct($address, $separator = '/')
    {
        $this->prepareAddress($address);
        $this->dispatch($separator);

    }

    /**
     * @param string $separator
     */

    public function dispatch($separator = '/'){
        $parts = explode($separator, StringHelper::ltrim($this->address, $separator));
        $this->controller = array_shift($parts) ?: self::DEFAULT_CONTROLLER;
        $this->action = array_shift($parts) ?: self::DEFAULT_ACTION;
        $this->prepareParts($parts);
    //    var_dump($this->controller,$this->action);
    }

    /**
     * @return string
     */
    public function getControllerPart() : string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getActionPart() : string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParamsPart() : array
    {
        return $this->params;
    }

    /**
     * @param string $address
     */

    private function prepareAddress(string $address) : void
    {
        $separator = strpos($address, '?');
        $upgradeAddress = $address;
        if($separator !== false){
        $upgradeAddress = substr($address, 0, $separator);
        }
        $this->address = $upgradeAddress;
    }

    /**
     * @param array $parts
     */

    private function prepareParts( array $parts) : void
    {
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


    //    var_dump($this->params);
}



}

