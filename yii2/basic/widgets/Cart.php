<?php


namespace app\widgets;


use app\models\entities\CartEntity;
use Yii;
use yii\base\Widget;
use yii\bootstrap\Html;

class Cart extends Widget
{
    public function run()
    {
        $count = CartEntity::find()->where(['user_id' => Yii::$app->user->getId()])->count();
        echo Html::a(Yii::t('app', "Cart: {number} item(s)", ['number' => $count]), ['/shop/cart']);
    }
}