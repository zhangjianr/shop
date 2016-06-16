<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IntegralGoods;

/**
 * IntegralGoodsSearch represents the model behind the search form about `backend\models\IntegralGoods`.
 */
class IntegralGoodsSearch extends IntegralGoods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id', 'integral', 'created_at', 'updated_at'], 'integer'],
            [['name', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = IntegralGoods::find()->where(['is_del' => self::DELETE_FALSE]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'shelves' => $this->shelves,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
