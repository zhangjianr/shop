<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Feedback;

/**
 * FeedbackSearch represents the model behind the search form about `backend\models\Feedback`.
 */
class FeedbackSearch extends Feedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status', 'type'], 'integer'],
            [['content', 'reply_content', 'id', 'uid'], 'safe'],
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
        $query = Feedback::find()->where(['type' => self::TYPE_SUPPLIER]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            "attributes" => [
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
                'uid' => [
                    'asc' => ['{{%company_reg}}.company_name' => SORT_ASC],
                    'desc' => ['{{%company_reg}}.company_name' => SORT_DESC],
                ],
                'content' => [
                    'asc' => ['content' => SORT_ASC],
                    'desc' => ['content' => SORT_DESC],
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                ],
            ],
            'defaultOrder' => [
                'status' => SORT_ASC,
                'created_at' => SORT_DESC,
            ]
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('companyReg');

        // grid filtering conditions


        $query->andFilterWhere(['like', '{{%company_reg}}.company_name', $this->uid]);

        return $dataProvider;
    }


    public function usearch($params)
    {
        $query = Feedback::find()->where(['type' => self::TYPE_USER]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            "attributes" => [
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
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                ],
            ],
            'defaultOrder' => [
                'status' => SORT_ASC,
                'created_at' => SORT_DESC,
            ]
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

        $query->andFilterWhere(['like', '{{%user}}.mobile', $this->uid]);
        $query->andFilterWhere(['like', '{{%person}}.name', $this->id]);

        return $dataProvider;
    }
}
