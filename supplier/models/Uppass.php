<?php
namespace supplier\models;

use Yii;
use yii\base\Model;
use common\models\CompanyReg;

/**
 * Signup form
 */
class Uppass extends Model
{
    public $password_hash;
    public $password_hash_two;
    public $password;
    private $_user;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','password_hash','password_hash_two'], 'required'],
            ['password','validatePassword'],
            ['password_hash_two','verifypass']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '原始密码不正确.');
            }
        }
    }

    public function verifypass($attribute, $params)
    {
        if($this->password_hash != $this->password_hash_two){
            $this->addError($attribute, '两次密码不一致.');
        }
    }

    protected function getUser()
    {
        $this->_user = CompanyReg::findByUsername(Yii::$app->user->identity->username);
        return $this->_user;
    }

    /**
     * 修改企业信息
     * @return CompanyReg|null
     * @author zhangjian
     */
    public function upsignup($data)
    {
        $model = CompanyReg::findOne( $data['Uppass']['id']);
        $model->setPassword($data['Uppass']['password_hash']);
        if($model->save()){
            return $model;
        }else{
            return null;
        }
    }

    public function attributeLabels()
    {
        return [
            'password_hash' => '密码',
            'password_hash_two' => '确认密码',
            'password' => '原密码',
        ];
    }
}
