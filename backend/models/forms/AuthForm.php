<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;
use backend\models\Admin;

/**
 * Signup form
 */
class AuthForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\Admin', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\Admin', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $admin = new Admin();
        $admin->username = $this->username;
        $admin->email = $this->email;
        $admin->setPassword($this->password);
        $admin->generateAuthKey();

        //给用户同时添加角色
        $auth = Yii::$app->authManager;
        $userRole = $auth->createRole($admin->username);
        $auth->add($userRole);
        if ($admin->save()) {
            $id = $admin->attributes['id'];
            $auth->assign($userRole, $id);
            return $admin;
        }

        return null;
    }
}
