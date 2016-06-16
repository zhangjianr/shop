<?php

namespace supplier\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use supplier\models\Goods;

/**
 * GoodsSearch represents the model behind the search form about `supplier\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id', 'service_cid', 'type_id', 'attri_id', 'created_at', 'updated_at', 'is_del', 'status'], 'integer'],
            [['service_name', 'detail'], 'safe'],
            [['price'], 'number'],
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
        $query = Goods::find();

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
            'image_id' => $this->image_id,
            'service_cid' => $this->service_cid,
            'type_id' => $this->type_id,
            'attri_id' => $this->attri_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_del' => $this->is_del,
            'status' => $this->status,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'service_name', $this->service_name])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
