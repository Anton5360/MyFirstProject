<?php


namespace app\components;

use app\exceptions\NotFoundException;
use ReflectionException;
use ReflectionMethod;

/**
 * Class Router
 * @package app\components
 */

class Router
{
    private ?Dispatcher $dispatcher = null;
    private string $controllerName = '';
    private string $actionName = '';

    /**
     * Router constructor.
     * @param $dispatcher
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->prepareControllerName($dispatcher->getControllerPart());
        $this->prepareActionName($dispatcher->getActionPart());
        $this->callControllerMethod($this->getProcessedControllerName(), $this->getProcessedActionName());
    }

    /**
     * @param $controllerName
     * @param $action
     * @throws ReflectionException
     * @throws NotFoundException
     */
    public function callControllerMethod($controllerName, $action) : void
    {
        $controller = new $controllerName();
        if(!class_exists($controllerName) || !method_exists($controller, $action)){
            throw new NotFoundException("Url is invalid");
        }
        $params = $this->dispatcher->getParamsPart();
        $preparedParams = $this->processedParams($controller, $action, $params);
        $output = $controller->$action(...$preparedParams);
        if($output && is_string($output)){
            echo $output;
            exit;
        }
    }

    /**
     * @param $controller
     * @throws NotFoundException
     */
    private function prepareControllerName($controller) : void
    {
        $prepareControllerName = '\\app\\controllers\\';
        $prepareControllerName .= $this->prepareWords($controller) . 'Controller';
        if(!class_exists($prepareControllerName)){
            throw new NotFoundException("Class {$controller} does not exists");
        }
        $this->controllerName = $prepareControllerName;
//        var_dump($prepareControllerName);exit;
    }

    /**
     * @param $action
     */
    private function prepareActionName($action) : void
    {
        $prepareActionName = 'action';
        $prepareActionName .= $this->prepareWords($action);
        $this->actionName = $prepareActionName;
//        var_dump($prepareActionName);exit;
    }

    /**
     * @param $words
     * @param string $needle
     * @return string
     */
    private function prepareWords($words, $needle = '-') : string
    {
        $prepareName = '';
        if(strpos($words, $needle) !== false){
            $explode = explode($needle, $words);
            foreach($explode as $key => $value){
                $explode[$key] = ucfirst(strtolower($value));
            }
            $prepareName .= implode('', $explode);
        } else {
            $prepareName .= ucfirst(strtolower($words));
        }
        return $prepareName;
    }

    /**
     * @return string
     */
    private function getProcessedControllerName() : string
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    private function getProcessedActionName() : string
    {
        return $this->actionName;
    }

    /**
     * @param object $controller
     * @param string $action
     * @param array $params
     * @return array
     * @throws ReflectionException
     */
    private function processedParams(object $controller, string $action,array $params) : array
    {
        $reflectionAction = new ReflectionMethod($controller, $action);
        $reflectionParams = $reflectionAction->getParameters();
        $requiredParamsQuantity = $reflectionAction->getNumberOfRequiredParameters();
        $result = [];
        foreach($reflectionParams as $param){
            if(array_key_exists($param->name,$params)){
                $result[] = $params[$param->name];
            } elseif(count($result) >= $requiredParamsQuantity){
                $result[] = null;
            } else{
                break;
            }
        }
        return $result;
//        var_dump($reflectionParams);exit;
    }
}
