<?php

use app\modules\models\forms\AddProductToCardForm;
use app\models\entities\ProductsEntity;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var ProductsEntity $model
 */


$mainImage = $model->getMainImage();
$image = $mainImage->url
    ? Html::img(['/products/image', 'url' => $mainImage->url], ['width' => '100%'])
    : Html::tag('h4', 'No image');

$addToCartModel = new AddProductToCardForm();
$addToCartModel->productID = $model->id;



?>

<div class="col-sm-3">
    <div class="product-image" style="width: 150px; height: 150px;"><?= $image ?></div>
    <div class="product-title" style="margin-top: 70px;"><?= $model->title ?></div>
    <div class="product-price"><?= Yii::$app->formatter->asCurrency($model->price) ?></div>
    <?php $form = ActiveForm::begin(['action' => '/shop/cart/add', 'method' => 'post'])  ?>
    <?= $form->field($addToCartModel, 'productID')->hiddenInput()->label(false) ?>
    <div><?= $form->field($addToCartModel, 'count')->textInput() ?></div>
    <?= Html::submitButton(Yii::t('app', 'Buy'), ['class' => 'btn btn-success'] ) ?>
    <?php ActiveForm::end(); ?>
</div>
