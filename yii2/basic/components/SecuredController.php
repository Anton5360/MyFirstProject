<?php

namespace app\components;

use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class SecuredController extends Controller
{

    /**
     * @param Action $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        if(parent::beforeAction($action) && Yii::$app->user->isGuest)
        {
            $this->redirect(['/site/login'])->send();
        }

        return true;
    }
}