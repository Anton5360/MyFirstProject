<?php

namespace app\models\entities;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property float $price
 * @property string $slug
 * @property string $created_at
 *
 * @property ProductsCategoriesEntity $category
 * @property ProductsImagesEntity[] $productsImages
 */
class ProductsEntity extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'products';
    }


    public function behaviors(): array
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
        ];
    }


    public function rules(): array
    {
        return [
            [['category_id', 'title', 'price'], 'required'],
            [['category_id'], 'integer'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['category_id'],
                'exist',
                'targetClass' => ProductsCategoriesEntity::class,
                'targetAttribute' => ['category_id' => 'id']],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'slug' => Yii::t('app', 'Slug'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(ProductsCategoriesEntity::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[ProductsImages]].
     *
     * @return ActiveQuery
     */
    public function getProductsImages(): ActiveQuery
    {
        return $this->hasMany(ProductsImagesEntity::class, ['product_id' => 'id']);
    }

    public function getMainImage(): ?ProductsImagesEntity
    {
        return $this->productsImages[0] ?? null;
    }
}
