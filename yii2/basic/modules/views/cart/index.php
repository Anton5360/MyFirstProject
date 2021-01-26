<?php

use app\models\entities\CartEntity;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */
$totalCartSum = CartEntity::find()->where(['user_id' => Yii::$app->user->id])->joinWith('product')->sum('price*count');


?>

<h1><?= $this->title ?></h1>

<div class="cart" style="margin-top: 50px;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showFooter' => true,
        'columns' => [
                [
                        'attribute' => 'product_id',
                        'value' => 'product.title',
                ],
            'count',
            [
                    'attribute' => Yii::t('app','Total'),
                    'value' => 'product.price',
                    'format' => 'Currency',
                    'footer' => Yii::$app->formatter->asCurrency($totalCartSum ?? 0),
            ],
            [
                    'class' => \yii\grid\ActionColumn::class,
                    'visibleButtons' => [
                            'view' => false,
                            'update' => false,
                    ]
                ]
        ]
    ]); ?>
</div>