<?php

namespace supplier\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use supplier\models\Person;

/**
 * PersonSearch represents the model behind the search form about `supplier\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'age', 'created_at', 'updated_at', 'integral', 'uid'], 'integer'],
            [['name', 'address', 'profession'], 'safe'],
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
        $query = Person::find();

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
            'sex' => $this->sex,
            'age' => $this->age,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'integral' => $this->integral,
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'profession', $this->profession]);

        return $dataProvider;
    }

    /**
     * c端客户使用
     * @param $params
     * @return ActiveDataProvider
     * @author zhangjian
     */
    public function csearch($params)
    {
        $query = Person::find()->joinWith(['ordercom'])->where(['shop_order_company.company_id' => Yii::$app->user->identity->id]);

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
            'sex' => $this->sex,
            'age' => $this->age,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'integral' => $this->integral,
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'profession', $this->profession]);

        return $dataProvider;
    }
}
