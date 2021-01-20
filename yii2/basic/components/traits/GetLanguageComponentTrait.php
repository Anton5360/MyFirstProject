<?php


namespace app\components\traits;


use app\components\LanguageComponent;
use Yii;

trait GetLanguageComponentTrait
{
    public function getComponent(string $name): LanguageComponent
    {
        return Yii::$app->get($name);
    }
}