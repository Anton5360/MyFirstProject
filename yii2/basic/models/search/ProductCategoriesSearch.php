<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\entities\ProductsCategoriesEntity;

/**
 * ProductCategoriesSearch represents the model behind the search form of `app\models\entities\ProductsCategoriesEntity`.
 */
class ProductCategoriesSearch extends ProductsCategoriesEntity
{

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['title', 'created_at'], 'safe'],
        ];
    }



    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = ProductsCategoriesEntity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
