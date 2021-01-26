<?php

use app\models\search\ProductCategoriesSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\grid\ActionColumn;

/**
 * @var View $this
 * @var ProductCategoriesSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */


$this->title = Yii::t('app', 'Products Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-categories-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'title',
            'created_at',

            ['class' => ActionColumn::class],
        ],
    ]); ?>


</div>
