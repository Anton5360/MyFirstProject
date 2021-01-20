<?php

use app\models\search\UserSearch;
use kartik\date\DatePicker;
use mdm\admin\components\Helper;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var View $this
 * @var UserSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->user->can('create')) : ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'username',
            'login',
            'is_active:boolean',
            [
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                    'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'created_at',
                            'pluginOptions' => [
                                    'autoclose' => true,
                            ]
                    ])
            ],

            [
                    'class' => ActionColumn::class,
                    'template' => Helper::filterActionColumn('{view} {update} {delete}'),
//                    'visibleButtons' => [
//                      'view' => Yii::$app->user->can('view'),
//                      'update' => Yii::$app->user->can('update'),
//                      'delete' => Yii::$app->user->can('delete'),
//                    ],
                ],
        ],
    ]); ?>


</div>
