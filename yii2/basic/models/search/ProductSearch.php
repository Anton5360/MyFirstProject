<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\entities\ProductsEntity;

/**
 * ProductSearch represents the model behind the search form of `app\models\entities\ProductsEntity`.
 */
class ProductSearch extends ProductsEntity
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['title', 'slug', 'created_at'], 'safe'],
            [['price'], 'number'],
        ];
    }


    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = ProductsEntity::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
        ])
        ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
