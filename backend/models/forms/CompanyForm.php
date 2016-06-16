<?php
namespace backend\models\forms;
// 无效的form表单
use backend\models\CompanyReg;
use common\core\backend\BackendModel;

class CompanyForm extends BackendModel{

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name','contact_name','phone','company_tel','industry','introduct','username','password_hash'], 'required'],
            [['introduct'], 'string'],
            [['company_tel','phone'], 'integer'],
            [['company_name', 'contact_name', 'industry'], 'string', 'max' => 64],
            [['company_tel', 'phone'], 'string', 'max' => 45],
            [['company_address', 'username', 'password_hash'], 'string', 'max' => 255],
            [['username'], 'unique',  'targetClass' => '\backend\models\CompanyReg', 'message' =>"用户名以存在"],
            [['credit','organization','tax','license'], 'file','extensions' => 'png, jpg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => '企业名称',
            'company_tel' => '企业电话',
            'company_address' => '企业地址',
            'contact_name' => '负责人姓名    ',
            'phone' => '手机号',
            'industry' => '所属行业',
            'introduct' => '企业简介',
            'username' => '账号',
            'password_hash' => '密码',
            'credit' => '社会信(三证合一)',
            'organization' => '组织结构代码',
            'tax' => '税务登记号',
            'license' => '营业执照',
            'rememberMe' => '记住'
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $model = new CompanyReg();
        $model->created_at = time();
        $model->company_name = $this->company_name;
        $model->contact_name = $this->contact_name;
        $model->company_address = $this->company_address;
        $model->company_tel = $this->company_tel;
        $model->phone = $this->phone;
        $model->industry = $this->industry;
        $model->introduct = $this->introduct;
        $model->username = $this->username;
        $model->generateAuthKey();
        $model->password_hash = $model->setPassword($this->password_hash);
        if($model->save()){
            return $model;
        }
        return null;
    }
    
}