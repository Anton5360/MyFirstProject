<?php

use app\models\entities\ProductsCategoriesEntity;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var ProductsCategoriesEntity $model
 */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products Categories Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);
?>
<div class="products-categories-entity-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'created_at',
        ],
    ]) ?>

</div>
