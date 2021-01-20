<?php

namespace app\models\search;

use DateTime;
use Exception;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\entities\UsersEntity;


class UserSearch extends UsersEntity
{

    public function rules(): array
    {
        return [
            ['id', 'integer'],
            ['is_active', 'boolean'],
            [['name', 'login', 'password', 'created_at'], 'safe'],
        ];
    }


    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     * @throws Exception
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = UsersEntity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->username])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'password', $this->password]);

        if ($this->created_at)
        {
            $date = new DateTime($this->created_at);
            $start = $date->format('Y-m-d 00:00:00');
            $end = $date->format('Y-m-d 23:59:59');

            $query->andFilterWhere(['between', 'created_at', $start, $end]);
        }

        return $dataProvider;
    }
}
