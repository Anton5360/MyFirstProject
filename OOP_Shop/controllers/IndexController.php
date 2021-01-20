<?php


namespace app\controllers;


use app\components\AbstractSecuredController;
use app\components\App;

class IndexController extends AbstractSecuredController
{
    public function actionIndex()
    {
        if(App::get()->user()->getIsGuest()){
            $this->redirect('/guest/login');
        }
       return App::get()->template()->render('index/index',['test' => 123]);
    }
}