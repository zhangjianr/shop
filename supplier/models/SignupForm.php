<?php
namespace supplier\models;

use Yii;
use yii\base\Model;
use common\models\CompanyReg;
use yii\behaviors\TimestampBehavior;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $id;
    public $company_name;
    public $contact_name;
    public $company_address;
    public $company_tel;
    public $phone;
    public $industry;
    public $introduct;
    public $username;
    public $password_hash;
    public $credit;
    public $organization;
    public $tax;
    public $license;
    public $isNewRecord;
    public $rememberMe;
    public $password_hash_two;
    public $license_num;
    public $organization_num;
    public $tax_num;
    public $province;
    public $city;
    public $country;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name','company_tel','contact_name','phone','company_address','industry','introduct','username','password_hash'], 'required'],
            [['introduct','province','city','country'], 'string'],
            [['company_tel','phone'], 'integer'],
            [['company_name', 'contact_name', 'industry'], 'string', 'max' => 64],
            [['company_tel', 'phone'], 'string', 'max' => 45],
            [['company_address', 'username', 'password_hash'], 'string', 'max' => 255],
            [['username'], 'unique','targetClass' => '\common\models\CompanyReg', 'message' =>"用户名以存在"],
            [['organization_num','tax_num','license_num','province','city','country'], 'safe'],
//            [['organization','tax','license'], 'file','extensions' => 'png, jpg']
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
        $user = new CompanyReg();
        if($user->findOne(['username'=>$this->username])){
            Yii::$app->session->setFlash('compuser',1);
            return null;
        }
        $user->username = $this->username;
        $user->company_name = $this->company_name;
        $user->company_tel = $this->company_tel;
        $user->company_address = $this->company_address;
        $user->contact_name = $this->contact_name;
        $user->phone = $this->phone;
        $user->industry = $this->industry;
        $user->introduct = $this->introduct;
        $user->province = $this->province;
        $user->city = $this->city;
        $user->country = $this->country;
        if($this->organization){
            $user->organization_num = $this->organization_num;
            $user->organization = $this->organization;
        }
        if($this->tax){
            $user->tax_num = $this->tax_num;
            $user->tax = $this->tax;
        }
        if($this->license){
            $user->license_num = $this->license_num;
            $user->license = $this->license;
        }

        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

    /**
     * 修改企业信息
     * @return CompanyReg|null
     * @author zhangjian
     */
    public function upsignup($data)
    {
        $model = CompanyReg::findOne( $data['SignupForm']['id']);
        $model->setPassword($data['SignupForm']['password_hash']);
        if($model->save()){
            return $model;
        }else{
            return null;
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => '企业名称',
            'company_tel' => '企业电话',
            'company_address' => '办公地址',
            'contact_name' => '负责人姓名',
            'phone' => '手机号',
            'industry' => '所属行业',
            'introduct' => '企业简介',
            'username' => '账号',
            'password_hash' => '密码',
            'organization' => '组织机构证照',
            'organization_num' => '组织结构代码',
            'tax' => '税务登记号证照',
            'tax_num' => '税务登记号代码',
            'license' => '营业执照证照',
            'license_num' => '营业执照代码',
            'rememberMe' => '记住',
            'password_hash_two' => '确认密码',
            'password' => '原密码',
        ];
    }

    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }
}
