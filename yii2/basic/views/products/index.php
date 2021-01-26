<?php

use app\models\entities\ProductsCategoriesEntity;
use app\models\entities\ProductsEntity;
use app\models\search\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * @var View $this
 * @var ProductSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                    'attribute' => 'category_id',
                    'value' => 'category.title',
                    'filter' => Html::activeDropDownList(
                            $searchModel,
                            'category_id',
                           ArrayHelper::map(ProductsCategoriesEntity::find()->all(), 'id','title'),
                        ['class' => 'form-control', 'prompt' => '--']
                    ),
            ],
            'title',
            [
                    'attribute' => 'image',
                'value' => static function (ProductsEntity $product){
                    $image = $product->productsImages[0] ?? null;

                    if(!$image){
                        return 'No images';
                    }

                    return Html::img(['image', 'url' => $image->url], ['width' => '50%']);

                },
                'format' => 'raw',
            ],
            [
                    'attribute' => 'price',
                    'format' => 'Currency'
            ],
            'slug',
            'created_at',

            ['class' => ActionColumn::class],
        ],
    ]); ?>


</div>
