<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'order_status', 'pay_status', 'type', 'created_at', 'updated_at', 'order_service', 'over_at', 'start_at', 'goods_id'], 'integer'],
            [['order_sn', 'order_fail', 'pay_note', 'inv_type'], 'safe'],
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
        $query = Order::find();

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
            'uid' => $this->uid,
            'order_status' => $this->order_status,
            'pay_status' => $this->pay_status,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'order_service' => $this->order_service,
            'over_at' => $this->over_at,
            'start_at' => $this->start_at,
            'goods_id' => $this->goods_id,
        ]);

        $query->andFilterWhere(['like', 'order_sn', $this->order_sn])
            ->andFilterWhere(['like', 'order_fail', $this->order_fail])
            ->andFilterWhere(['like', 'pay_note', $this->pay_note])
            ->andFilterWhere(['like', 'inv_type', $this->inv_type]);

        return $dataProvider;
    }
}
