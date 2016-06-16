<?php

namespace supplier\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use supplier\models\Reply;

/**
 * ReplySearch represents the model behind the search form about `supplier\models\Reply`.
 */
class ReplySearch extends Reply
{
    public $order_sn;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid', 'did', 'order_id', 'type', 'created_at', 'start'], 'integer'],
            [['content','order_sn'], 'safe'],
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
        $query = Reply::find()->joinWith('order o', 'o.id = order_id');

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
            'sid' => $this->sid,
            'did' => $this->did,
            'order_id' => $this->order_id,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'start' => $this->start,
        ]);
        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'o.order_sn', $this->order_sn]);

        return $dataProvider;
    }
}
