<?php

use app\models\entities\ProductsEntity;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var  View $this
 * @var ProductsEntity $model
 */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-entity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
