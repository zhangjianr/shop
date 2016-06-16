<?php

namespace backend\models\searchs;

use backend\models\CouponsNumber;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Coupons;

/**
 * CouponsSearch represents the model behind the search form about `backend\models\Coupons`.
 */
class CouponsSearch extends Coupons
{
    public $cname;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'name', 'description'], 'safe'],
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
        $query = Coupons::find();

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


        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function listSearch($params)
    {
        $query = CouponsNumber::find();

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


        $query->joinWith('order');
        $query->joinWith('coupons');

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', '{{%coupons}}.name.', $this->cname]);

        return $dataProvider;
    }
}
