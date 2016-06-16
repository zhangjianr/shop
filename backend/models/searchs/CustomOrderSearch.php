<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CustomOrder;

/**
 * CustomOrderSearch represents the model behind the search form about `backend\models\CustomOrder`.
 */
class CustomOrderSearch extends CustomOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cate_id', 'created_at', 'updated_at', 'over_at'], 'integer'],
            [['contact', 'tel', 'content', 'order_sn'], 'safe'],
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
        $query = CustomOrder::find();

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
            'id' => $this->id,
            'cate_id' => $this->cate_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'over_at' => $this->over_at,
        ]);

        $query->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'order_sn', $this->order_sn]);

        return $dataProvider;
    }
}
