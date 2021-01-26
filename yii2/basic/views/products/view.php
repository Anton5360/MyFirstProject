<?php

use app\models\entities\ProductsEntity;
use app\models\forms\AddProductImagesForm;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var ProductsEntity $model
 * @var AddProductImagesForm $imageFiles
 */





$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="products-entity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php foreach ($model->productsImages as $image) : ?>
    <?= Html::img(['image', 'url' => $image->url], ['class' => 'col-sm-3']) ?>
    <?php endforeach ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'title',
            'price',
            'slug',
            'created_at',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($imageFiles, 'imageFiles[]')
        ->fileInput(['multiple' => true, 'accept' => 'image/*'])
        ->label(Yii::t('app', 'Upload photos')) ?>

    <?= Html::submitButton(Yii::t('app', 'Add images'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end() ?>

</div>
