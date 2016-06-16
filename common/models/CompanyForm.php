<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class CompanyForm extends Model
{
    public $username;
    public $password_hash;
    public $rememberMe = true;
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password_hash'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password_hash', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password_hash)) {
                $this->addError($attribute, '用户名或密码错误.');
            }else if($user->is_del == 10){
                $this->addError($attribute, '用户已被删除.');
            }else if($user->is_lock == 10){
                $this->addError($attribute, '用户已被锁定.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = CompanyReg::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function attributeLabels(){
        return [
            'username' => '姓名',
            'password_hash' => '密码',
            'rememberMe' => '记住',
        ];
    }
}
