<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\entities\ProductsCategoriesEntity */

$this->title = Yii::t('app', 'Create Products Categories Entity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products Categories Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-categories-entity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
