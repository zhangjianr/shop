<?php
namespace backend\models\forms;

use Yii;
use backend\models\CompanyReg;
use common\core\backend\BackendModel;

class SupplierForm extends BackendModel
{
    public $id;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['id', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'password_repeat' => '确认密码'
        ];
    }


    public function updatePass()
    {
        if (!$this->validate()) {
            return null;
        }
        $password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $auth_key = Yii::$app->security->generateRandomString();

        $res = Yii::$app->db->createCommand()->update(CompanyReg::tableName(), ['password_hash'=>$password_hash, 'auth_key' => $auth_key], ['id' => $this->id])->execute();
        return $res ? true :false;
    }


}