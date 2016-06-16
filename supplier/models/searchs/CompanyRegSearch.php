<?php

namespace supplier\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use supplier\models\CompanyReg;

/**
 * CompanyRegSearch represents the model behind the search form about `supplier\models\CompanyReg`.
 */
class CompanyRegSearch extends CompanyReg
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['company_name', 'company_tel', 'company_address', 'contact_name', 'phone', 'industry', 'introduct', 'username', 'auth_key', 'password_hash', 'credit', 'organization', 'tax', 'license'], 'safe'],
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
        $query = CompanyReg::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_tel', $this->company_tel])
            ->andFilterWhere(['like', 'company_address', $this->company_address])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'industry', $this->industry])
            ->andFilterWhere(['like', 'introduct', $this->introduct])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'credit', $this->credit])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'tax', $this->tax])
            ->andFilterWhere(['like', 'license', $this->license]);

        return $dataProvider;
    }
}
