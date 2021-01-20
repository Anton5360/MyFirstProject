<?php


namespace app\controllers;


use app\components\SecuredController;

class TestingController extends SecuredController
{
    public function actionIndex()
    {
        var_dump('Hello world!');
    }
}