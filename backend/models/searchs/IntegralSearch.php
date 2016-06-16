<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Integral;

/**
 * IntegralSearch represents the model behind the search form about `backend\models\Integral`.
 */
class IntegralSearch extends Integral
{

    public $mobile;
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'integral', 'created_at', 'uid', 'number'], 'integer'],
            [['description', 'mobile',  'name'], 'safe'],
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
        $query = Integral::find();


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
                'user.mobile' => [
                    'asc' => ['{{%user}}.mobile' => SORT_ASC],
                    'desc' => ['{{%user}}.mobile' => SORT_DESC],
                ],
                'person.name' => [
                    'asc' => ['{{%person}}.name' => SORT_ASC],
                    'desc' => ['{{%person}}.name' => SORT_DESC],
                ],
                'integral' => [
                    'asc' => ['integral' => SORT_ASC],
                    'desc' => ['integral' => SORT_DESC],
                ],
                'description' => [
                    'asc' => ['description' => SORT_ASC],
                    'desc' => ['description' => SORT_DESC],
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                ],
            ],
            'defaultOrder' => [
                'created_at' => SORT_DESC,

            ],
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('user');
        $query->joinWith('person');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'integral' => $this->integral,
            'created_at' => $this->created_at,
            'uid' => $this->uid,
            'number' => $this->number,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', '{{%user}}.mobile', $this->mobile]);
        $query->andFilterWhere(['like', '{{%person}}.name', $this->name]);

        return $dataProvider;
    }


    public function dealSearch($params)
    {
        $query = Integral::find();

        if(count($params) <= 1) {
            $query->andWhere(['{{%integral}}.id' => false]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
                'user.mobile' => [
                    'asc' => ['{{%user}}.mobile' => SORT_ASC],
                    'desc' => ['{{%user}}.mobile' => SORT_DESC],
                ],
                'person.name' => [
                    'asc' => ['{{%person}}.name' => SORT_ASC],
                    'desc' => ['{{%person}}.name' => SORT_DESC],
                ],
                'integral' => [
                    'asc' => ['integral' => SORT_ASC],
                    'desc' => ['integral' => SORT_DESC],
                ]
            ],
            'defaultOrder' => [
                'id' => SORT_ASC
            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('user');
        $query->joinWith('person');


        $query->andFilterWhere(['like', '{{%user}}.mobile', $this->mobile]);
        $query->andFilterWhere(['like', '{{%person}}.name', $this->name]);

        return $dataProvider;
    }
}

