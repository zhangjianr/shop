<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Special;

/**
 * SpecialSearch represents the model behind the search form about `backend\models\Special`.
 */
class SpecialSearch extends Special
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id', 'is_del', 'is_open', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'starttime', 'endtime'], 'safe'],
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
        $query = Special::find()->where(['is_del' => self::DELETE_FALSE, 'is_open' => self::OPEN_TRUE]);

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

        $query->andFilterWhere(['like', 'title', $this->title]);
        if ($this->starttime != null)
            $query->andFilterWhere(['<=', "starttime", strtotime($this->starttime)]);
        if ($this->endtime != null)
            $query->andFilterWhere(['>=', "endtime", strtotime($this->endtime)]);

        return $dataProvider;
    }
}
