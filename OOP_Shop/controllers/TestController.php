<?php


namespace app\controllers;


use app\components\App;

class TestController
{
    public function actionQwerty(int $id, string $title, ?string $value = '')
    {
        var_dump(App::get());exit;
    }

    public function actionHelloWorld()
    {
        var_dump('Hello, world!');
    }
}