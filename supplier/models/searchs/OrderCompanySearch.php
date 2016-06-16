<?php

namespace supplier\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use supplier\models\OrderCompany;

/**
 * searchs represents the model behind the search form about `supplier\models\OrderCompany`.
 */
class OrderCompanySearch extends OrderCompany
{
    public $type_id;
    public $order_sn;
    public $cate_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'company_id', 'create_at', 'over_time', 'status'], 'integer'],
            [['order_sn','cate_id','type_id'], 'safe'],
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
        $query = OrderCompany::find()->joinWith('order o')->where(['company_id' => Yii::$app->user->id]);

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

        $query->andFilterWhere([
            'status' => $this->status,
        ]);
        
        // grid filtering conditions
        $query->andFilterWhere(['like', 'o.order_sn', $this->order_sn]);
        $query->andFilterWhere(['like', 'o.cate_id', $this->cate_id]);
        $query->andFilterWhere(['like', 'o.type_id', $this->type_id]);

        return $dataProvider;
    }

    /**
     * 业务列表
     * @param $params
     * @return ActiveDataProvider
     * @author zhangjian
     */
    public function listsearch($params,$uid='')
    {
        $query = OrderCompany::find()->joinWith('order')->where(['shop_order_company.company_id' => Yii::$app->user->identity->id, 'uid'=>$uid]);

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
            'order_id' => $this->order_id,
            'company_id' => $this->company_id,
            'create_at' => $this->create_at,
            'over_time' => $this->over_time,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
