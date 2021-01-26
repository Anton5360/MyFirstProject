<?php

namespace app\models\entities;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products_categories".
 *
 * @property int $id
 * @property string $title
 * @property string $created_at
 *
 * @property ProductsEntity[] $products
 */
class ProductsCategoriesEntity extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'products_categories';
    }


    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return ActiveQuery
     */
    public function getProducts(): ActiveQuery
    {
        return $this->hasMany(ProductsEntity::class, ['category_id' => 'id']);
    }
}
