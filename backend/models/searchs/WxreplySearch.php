<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Wxreply;

/**
 * WxreplySearch represents the model behind the search form about `backend\models\Wxreply`.
 */
class WxreplySearch extends Wxreply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kid', 'sort'], 'integer'],
            [['title', 'description', 'picurl', 'url'], 'safe'],
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
        $query = Wxreply::find();

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
            'kid' => $this->kid,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'picurl', $this->picurl])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
