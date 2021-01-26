<?php

namespace app\models\entities;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products_images".
 *
 * @property int $id
 * @property int $product_id
 * @property string $url
 * @property int $is_main
 * @property string $created_at
 *
 * @property ProductsEntity $product
 */
class ProductsImagesEntity extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'products_images';
    }


    public function rules(): array
    {
        return [
            [['product_id', 'url'], 'required'],
            [['product_id'], 'integer'],
            [['is_main'], 'boolean'],
            [['created_at'], 'safe'],
            [['url'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['product_id'],
                'exist',
                'targetClass' => ProductsEntity::class,
                'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'url' => Yii::t('app', 'Url'),
            'is_main' => Yii::t('app', 'Is Main'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return ActiveQuery
     */
    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(ProductsEntity::class, ['id' => 'product_id']);
    }
}
