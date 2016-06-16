<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyReg;

/**
 * CompanyRegSearch represents the model behind the search form about `backend\models\CompanyReg`.
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
            [['company_name', 'company_tel', 'company_address', 'contact_name', 'phone', 'industry', 'introduct', 'username', 'auth_key', 'password_hash', 'organization', 'tax', 'license'], 'safe'],
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
        $query = CompanyReg::find()->where(['status' => self::AUDIT_TRUE, 'is_del' => self::DELETE_FALSE]);

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

        $query->andFilterWhere(['like', 'company_tel', $this->company_tel])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchAudit($params)
    {
        $query = CompanyReg::find()->where(['<>', 'status', self::AUDIT_TRUE]);

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

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'username', $this->username]);
        return $dataProvider;
    }
}
