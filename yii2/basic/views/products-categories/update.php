<?php

use app\models\entities\ProductsCategoriesEntity;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ProductsCategoriesEntity $model
 */


$this->title = Yii::t('app', 'Update Products Categories Entity: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products Categories Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="products-categories-entity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
