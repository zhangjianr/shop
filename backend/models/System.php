<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%system}}".
 *
 * @property integer $id
 * @property string $integral_rule
 */
class System extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['integral_rule'], 'required', 'on' => 'rule'],
            [['integral_rule'], 'string'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['rule'] = ['integral_rule'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'integral_rule' => '积分规则',
        ];
    }
}
