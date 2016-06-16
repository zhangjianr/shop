<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IntegralOrder;

/**
 * IntegralOrderSearch represents the model behind the search form about `backend\models\IntegralOrder`.
 */
class IntegralOrderSearch extends IntegralOrder
{
    public $uname;
    public $goodsname;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gid', 'uid', 'type', 'is_del', 'integral', 'created_at', 'updated_at', 'ship_at'], 'integer'],
            [['uname','goodsname','express_company', 'express_num', 'address', 'contact', 'mobile', 'order_sn'], 'safe'],
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
        $query = IntegralOrder::find()->where([self::tableName().'.is_del' => self::DELETE_FALSE]);

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
                'igoods.name' => [
                    'asc' => ['{{%integral_goods}}.name' => SORT_ASC],
                    'desc' => ['{{%integral_goods}}.name' => SORT_DESC],
                ],
                'person.name' => [
                    'asc' => ['{{%person}}.name' => SORT_ASC],
                    'desc' => ['{{%person}}.name' => SORT_DESC],
                ],
                'user.mobile' => [
                    'asc' => ['{{%user}}.name' => SORT_ASC],
                    'desc' => ['{{%user}}.name' => SORT_DESC],
                ],
                'integral' => [
                    'asc' => ['integral' => SORT_ASC],
                    'desc' => ['integral' => SORT_DESC],
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
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
        $query->joinWith('igoods');
        $query->joinWith('person');


        $query->andFilterWhere(['like', '{{%person}}.name', $this->uname])
            ->andFilterWhere(['like', '{{%integral_goods}}.name', $this->goodsname]);

        return $dataProvider;
    }
}
